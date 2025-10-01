<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Events\OrderUpdated; // We will create this event later
use App\Events\OrderItemUpdated; // We will create this event later

class KokiController extends Controller
{
    /**
     * Display a listing of pending or preparing orders for the chef.
     */
    public function index()
    {
        $orders = Order::with(['table', 'orderItems.product'])
                       ->whereIn('status', ['pending', 'preparing'])
                       ->orderBy('created_at', 'asc')
                       ->get(); // Use get() for all relevant orders, not paginate for koki view

        return view('koki.index', compact('orders')); // We will create this view later
    }

    /**
     * Mark an individual order item as 'made'.
     */
    public function markItemMade(Request $request, OrderItem $orderItem)
    {
        // Validate the request if needed (e.g., ensure only koki can do this)
        // For now, we'll assume proper authentication/authorization is in place.

        if ($orderItem->status === 'made') {
            return response()->json(['message' => 'Item already marked as made.'], 409);
        }

        $orderItem->status = 'made';
        $orderItem->save();

        // Broadcast the individual item status change
        broadcast(new OrderItemUpdated($orderItem))->toOthers();

        $order = $orderItem->order;

        // Check if all items in the order are now 'made'
        $allOrderItemsMade = $order->orderItems->every(function ($item) {
            return $item->status === 'made';
        });

        // If all items are made, update the parent order's status to 'preparing'
        // if it's currently 'pending'.
        if ($allOrderItemsMade && $order->status === 'pending') {
            $order->status = 'preparing';
            $order->save();
            // Broadcast the overall order status change
            broadcast(new OrderUpdated($order))->toOthers();
        } elseif ($order->status === 'pending') {
            // If not all items are made, but at least one is, and order is pending,
            // change order status to 'preparing'.
            $order->status = 'preparing';
            $order->save();
            broadcast(new OrderUpdated($order))->toOthers();
        }
        
        // Log for debugging
        Log::info("OrderItem {$orderItem->id} marked as made. Order {$order->id} status: {$order->status}");

        return response()->json([
            'message' => 'Order item marked as made successfully.',
            'order_item_status' => $orderItem->status,
            'order' => $order->load('orderItems.product', 'table'), // Return full updated order
        ]);
    }

    /**
     * Mark an entire order as 'ready'.
     * This should only be called when all items are already 'made'.
     */
    public function markOrderReady(Order $order)
    {
        // Ensure all items are made before marking order as ready
        $allOrderItemsMade = $order->orderItems->every(function ($item) {
            return $item->status === 'made';
        });

        if (!$allOrderItemsMade) {
            return response()->json(['message' => 'Not all items are marked as made yet.'], 400);
        }

        if ($order->status === 'ready') {
            return response()->json(['message' => 'Order already marked as ready.'], 409);
        }

        $order->status = 'ready';
        $order->save();

        // Broadcast the overall order status change
        broadcast(new OrderUpdated($order))->toOthers();

        // Log for debugging
        Log::info("Order {$order->id} marked as ready.");

        return response()->json([
            'message' => 'Order marked as ready successfully.',
            'order' => $order->load('orderItems.product', 'table'), // Return full updated order
        ]);
    }
}