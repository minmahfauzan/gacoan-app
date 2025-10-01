<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Events\OrderUpdated; // Use the existing event

class PelayanController extends Controller
{
    /**
     * Display a listing of ready orders for the waiter.
     */
    public function index()
    {
        $orders = Order::with(['table', 'orderItems.product'])
                       ->where('status', 'ready')
                       ->orderBy('created_at', 'asc')
                       ->get();

        return view('pelayan.index', compact('orders')); // We will create this view later
    }

    /**
     * Mark an entire order as 'served'.
     */
    public function markOrderServed(Order $order)
    {
        if ($order->status === 'served') {
            return response()->json(['message' => 'Order already marked as served.'], 409);
        }

        $order->status = 'served';
        $order->save();

        // Broadcast the overall order status change
        broadcast(new OrderUpdated($order))->toOthers();

        // Log for debugging
        Log::info("Order {$order->id} marked as served.");

        return response()->json([
            'message' => 'Order marked as served successfully.',
            'order' => $order->load('orderItems.product', 'table'),
        ]);
    }
}