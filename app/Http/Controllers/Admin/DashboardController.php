<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $orders = Order::with('table')
                      ->orderBy('created_at', 'desc')
                      ->limit(10)
                      ->get();
                      
        $pendingOrders = Order::where('status', 'pending')->count();
        $preparingOrders = Order::where('status', 'preparing')->count();
        $readyOrders = Order::where('status', 'ready')->count();
        $totalOrders = Order::count();
        
        return view('admin.dashboard', compact('orders', 'pendingOrders', 'preparingOrders', 'readyOrders', 'totalOrders'));
    }
}