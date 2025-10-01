@extends('admin.layouts.app')

@section('title', 'Orders Management')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Orders Management</h1>
    <p class="text-gray-600">Manage and track all customer orders</p>
</div>

<!-- Filters -->
<div class="bg-white rounded-xl shadow-md p-6 mb-6">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
            <select class="w-full rounded-lg border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">
                <option>All Statuses</option>
                <option>Pending</option>
                <option>Preparing</option>
                <option>Ready</option>
                <option>Served</option>
            </select>
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Table</label>
            <select class="w-full rounded-lg border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">
                <option>All Tables</option>
                <!-- Tables will be populated dynamically -->
            </select>
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Date Range</label>
            <select class="w-full rounded-lg border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">
                <option>Today</option>
                <option>This Week</option>
                <option>This Month</option>
                <option>Last 30 Days</option>
            </select>
        </div>
        
        <div class="flex items-end">
            <button class="w-full bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2 px-4 rounded-lg transition">
                Reset Filters
            </button>
        </div>
    </div>
</div>

<!-- Orders Table -->
<div class="bg-white rounded-xl shadow-md overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order #</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Pemesan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Table</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Items</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Time</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($orders as $order)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        {{ $order->order_number }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $order->nama_pemesan }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $order->table->table_number }}
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500">
                        <div class="flex flex-wrap gap-1">
                            @foreach($order->orderItems->take(3) as $item)
                                <span class="bg-gray-100 px-2 py-1 rounded text-xs">{{ $item->product->name }}</span>
                            @endforeach
                            @if($order->orderItems->count() > 3)
                                <span class="bg-gray-100 px-2 py-1 rounded text-xs">+{{ $order->orderItems->count() - 3 }} more</span>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        Rp{{ number_format($order->total_amount, 0, ',', '.') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <select 
                            class="status-select rounded-full text-xs font-semibold px-3 py-1 focus:outline-none focus:ring-2 focus:ring-red-500
                                @switch($order->status)
                                    @case('pending') bg-yellow-100 text-yellow-800 @break
                                    @case('preparing') bg-blue-100 text-blue-800 @break
                                    @case('ready') bg-green-100 text-green-800 @break
                                    @case('served') bg-purple-100 text-purple-800 @break
                                @endswitch"
                            data-order-id="{{ $order->id }}"
                            data-current-status="{{ $order->status }}">
                            <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="preparing" {{ $order->status === 'preparing' ? 'selected' : '' }}>Preparing</option>
                            <option value="ready" {{ $order->status === 'ready' ? 'selected' : '' }}>Ready</option>
                            <option value="served" {{ $order->status === 'served' ? 'selected' : '' }}>Served</option>
                        </select>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $order->created_at->format('d M Y, H:i') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <button 
                            class="view-details text-red-600 hover:text-red-900 mr-3"
                            data-order-id="{{ $order->id }}">
                            View
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        <p>No orders found</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <!-- Pagination -->
    @if($orders->hasPages())
    <div class="bg-white px-6 py-3 border-t border-gray-200">
        {{ $orders->links() }}
    </div>
    @endif
</div>

<!-- Order Details Modal -->
<div id="order-modal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
    <div class="absolute inset-0 flex items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold text-gray-800">Order Details</h3>
                    <button id="close-modal" class="text-gray-500 hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                
                <div id="order-details-content">
                    <!-- Order details will be loaded here -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Status change handler
        $('.status-select').change(function() {
            const orderId = $(this).data('order-id');
            const newStatus = $(this).val();
            const currentStatus = $(this).data('current-status');
            
            if (confirm(`Are you sure you want to change the status to "${newStatus}"?`)) {
                $.ajax({
                    url: `/admin/orders/${orderId}/update-status`,
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        status: newStatus
                    },
                    success: function(response) {
                        if (response.success) {
                            alert(response.message);
                            // Update the select box class
                            updateStatusClass($(this), newStatus);
                        }
                    }.bind(this),
                    error: function() {
                        alert('Failed to update status. Please try again.');
                        // Revert to previous status
                        $(this).val(currentStatus);
                    }.bind(this)
                });
            } else {
                // Revert to previous status
                $(this).val(currentStatus);
            }
        });
        
        // View order details
        $('.view-details').click(function() {
            const orderId = $(this).data('order-id');
            
            $.get(`/admin/orders/${orderId}`, function(data) {
                $('#order-details-content').html(data);
                $('#order-modal').removeClass('hidden');
            });
        });
        
        // Close modal
        $('#close-modal').click(function() {
            $('#order-modal').addClass('hidden');
        });

        $('#order-modal').click(function(e) {
            if (e.target === this) {
                $('#order-modal').addClass('hidden');
            }
        });
        
        function updateStatusClass(element, status) {
            // Remove all status classes
            element.removeClass('bg-yellow-100 text-yellow-800 bg-blue-100 text-blue-800 bg-green-100 text-green-800 bg-purple-100 text-purple-800');
            
            // Add appropriate class based on status
            switch(status) {
                case 'pending':
                    element.addClass('bg-yellow-100 text-yellow-800');
                    break;
                case 'preparing':
                    element.addClass('bg-blue-100 text-blue-800');
                    break;
                case 'ready':
                    element.addClass('bg-green-100 text-green-800');
                    break;
                case 'served':
                    element.addClass('bg-purple-100 text-purple-800');
                    break;
            }
        }
    });
</script>
@endsection