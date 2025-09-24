<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\TableModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $cart = Session::get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('menu.index')->with('error', 'Your cart is empty');
        }
        
        $tableId = Session::get('table_id');
        
        if (!$tableId) {
            return redirect()->route('table.auth.login');
        }
        
        DB::beginTransaction();
        
        try {
            // Create order
            $order = Order::create([
                'order_number' => 'ORD-' . strtoupper(uniqid()),
                'table_id' => $tableId,
                'total_amount' => array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart)),
                'status' => 'pending'
            ]);
            
            // Create order items
            foreach ($cart as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'total' => $item['price'] * $item['quantity']
                ]);
            }
            
            // Clear cart
            Session::forget('cart');
            
            DB::commit();
            
            return redirect()->route('order.status', $order->id)
                           ->with('success', 'Order placed successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('menu.index')
                           ->with('error', 'Failed to place order. Please try again.');
        }
    }
    
    public function status($id)
    {
        $order = Order::with('orderItems.product')
                     ->where('id', $id)
                     ->where('table_id', Session::get('table_id'))
                     ->firstOrFail();
        
        return view('order.status', compact('order'));
    }
}