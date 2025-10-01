<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['table', 'orderItems.product'])
                       ->orderBy('created_at', 'desc')
                       ->paginate(15);
                       
        return view('admin.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with(['table', 'orderItems.product'])->findOrFail($id);

        return view('admin.orders.show', compact('order'));
    }
    
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,preparing,ready,served'
        ]);
        
        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();
        
        return response()->json([
            'success' => true,
            'message' => 'Order status updated successfully!',
            'status' => $order->status
        ]);
    }

    public function cancel(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'cancelled';
        $order->save();

        return response()->json([
            'success' => true,
            'message' => 'Order has been cancelled.',
            'status' => 'cancelled'
        ]);
    }
}