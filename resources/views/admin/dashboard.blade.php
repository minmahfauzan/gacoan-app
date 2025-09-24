@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Dashboard Overview</h1>
    <p class="text-gray-600">Welcome back! Here's what's happening today.</p>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-xl shadow-md p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-lg bg-red-100 text-red-600 mr-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
            </div>
            <div>
                <p class="text-gray-500 text-sm">Total Orders</p>
                <p class="text-2xl font-bold">{{ $totalOrders }}</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-md p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-lg bg-yellow-100 text-yellow-600 mr-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <p class="text-gray-500 text-sm">Pending</p>
                <p class="text-2xl font-bold">{{ $pendingOrders }}</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-md p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-lg bg-blue-100 text-blue-600 mr-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
            </div>
            <div>
                <p class="text-gray-500 text-sm">Preparing</p>
                <p class="text-2xl font-bold">{{ $preparingOrders }}</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-md p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-lg bg-green-100 text-green-600 mr-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <div>
                <p class="text-gray-500 text-sm">Ready</p>
                <p class="text-2xl font-bold">{{ $readyOrders }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Recent Orders -->
<div class="bg-white rounded-xl shadow-md p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-bold text-gray-800">Recent Orders</h2>
        <a href="{{ route('admin.orders.index') }}" class="text-red-600 hover:text-red-800 font-medium">
            View All
        </a>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order #</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Table</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Items</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Time</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($orders as $order)
                <tr>
                    <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900">
                        {{ $order->order_number }}
                    </td>
                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">
                        {{ $order->table->table_number }}
                    </td>
                    <td class="px-4 py-3 text-sm text-gray-500">
                        {{ $order->orderItems->count() }} items
                    </td>
                    <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900">
                        Rp{{ number_format($order->total_amount, 0, ',', '.') }}
                    </td>
                    <td class="px-4 py-3 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                            @switch($order->status)
                                @case('pending') bg-yellow-100 text-yellow-800 @break
                                @case('preparing') bg-blue-100 text-blue-800 @break
                                @case('ready') bg-green-100 text-green-800 @break
                                @case('served') bg-purple-100 text-purple-800 @break
                            @endswitch">
                            {{ ucfirst($order->status) }}
                        </span>
                    </td>
                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">
                        {{ $order->created_at->format('H:i') }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-4 py-8 text-center text-gray-500">
                        No recent orders found
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection