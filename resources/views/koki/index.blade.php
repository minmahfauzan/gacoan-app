<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koki Dashboard</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #fef3e2;
        }
    </style>
</head>

<body class="min-h-screen flex flex-col">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Daftar Pesanan Koki</h1>

        <div id="orders-list" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($orders as $order)
                <div id="order-card-{{ $order->id }}" class="bg-white shadow-lg rounded-lg p-6 border-t-4 @if($order->status === 'preparing') border-yellow-500 @elseif($order->status === 'ready') border-green-500 @else border-blue-500 @endif">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-semibold">Pesanan #{{ $order->order_number }}</h2>
                        <span class="px-3 py-1 rounded-full text-sm font-medium @if($order->status === 'pending') bg-gray-200 text-gray-800 @elseif($order->status === 'preparing') bg-yellow-200 text-yellow-800 @elseif($order->status === 'ready') bg-green-200 text-green-800 @else bg-blue-200 text-blue-800 @endif">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>
                    <p class="text-gray-600 mb-2">Meja: {{ $order->table->table_number }}</p>
                    <p class="text-gray-600 mb-2">Pemesan: {{ $order->nama_pemesan ?? 'Anonim' }}</p>
                    @if ($order->keterangan)
                        <p class="text-gray-600 mb-4">Catatan: {{ $order->keterangan }}</p>
                    @endif

                    <h3 class="text-lg font-medium mb-3">Item Pesanan:</h3>
                    <ul class="space-y-2 mb-4">
                        @foreach ($order->orderItems as $item)
                            <li id="order-item-{{ $item->id }}" class="flex justify-between items-center p-3 rounded-md @if($item->status === 'made') bg-green-50 @else bg-gray-50 @endif">
                                <div>
                                    <span class="font-medium">{{ $item->product->name }}</span>
                                    <span class="text-gray-500"> (x{{ $item->quantity }})</span>
                                </div>
                                <button data-order-item-id="{{ $item->id }}"
                                        class="mark-item-made-btn px-3 py-1 text-sm rounded-md @if($item->status === 'made') bg-green-500 text-white cursor-not-allowed @else bg-blue-500 text-white hover:bg-blue-600 @endif"
                                        @if($item->status === 'made') disabled @endif>
                                    @if($item->status === 'made') Dibuat @else Tandai Dibuat @endif
                                </button>
                            </li>
                        @endforeach
                    </ul>

                    <div class="text-right">
                        @php
                            $allOrderItemsMade = $order->orderItems->every(fn ($item) => $item->status === 'made');
                        @endphp
                        <button data-order-id="{{ $order->id }}"
                                class="mark-order-ready-btn px-4 py-2 rounded-md text-white font-semibold @if($order->status === 'ready') bg-green-500 cursor-not-allowed @else bg-purple-600 hover:bg-purple-700 @endif"
                                @if($order->status === 'ready' || !$allOrderItemsMade) disabled @endif
                                @if(!$allOrderItemsMade) style="display: none;" @endif>
                            @if($order->status === 'ready') Siap Disajikan @else Tandai Siap @endif
                        </button>
                    </div>
                </div>
            @empty
                <p class="text-gray-600">Tidak ada pesanan yang menunggu.</p>
            @endforelse
        </div>
    </div>

    <script type="module">
        // Laravel Echo setup is in bootstrap.js, so it should be available globally
        // window.Echo

        document.addEventListener('DOMContentLoaded', function () {
            const ordersList = document.getElementById('orders-list');

            // Function to update order item status in UI
            function updateOrderItemUI(orderItemId, newStatus) {
                const itemElement = document.getElementById(`order-item-${orderItemId}`);
                if (itemElement) {
                    const button = itemElement.querySelector('.mark-item-made-btn');
                    if (newStatus === 'made') {
                        itemElement.classList.remove('bg-gray-50');
                        itemElement.classList.add('bg-green-50');
                        button.classList.remove('bg-blue-500', 'hover:bg-blue-600');
                        button.classList.add('bg-green-500', 'cursor-not-allowed');
                        button.textContent = 'Dibuat';
                        button.disabled = true;
                    }
                }
            }

            // Function to update order card status in UI
            function updateOrderCardUI(updatedOrder) {
                const cardElement = document.getElementById(`order-card-${updatedOrder.id}`);
                if (cardElement) {
                    const statusSpan = cardElement.querySelector('span');
                    const readyButton = cardElement.querySelector('.mark-order-ready-btn');

                    // Update status text and color
                    statusSpan.textContent = updatedOrder.status.charAt(0).toUpperCase() + updatedOrder.status.slice(1);
                    statusSpan.classList.remove('bg-gray-200', 'text-gray-800', 'bg-yellow-200', 'text-yellow-800', 'bg-green-200', 'text-green-800', 'bg-blue-200', 'text-blue-800');
                    cardElement.classList.remove('border-yellow-500', 'border-green-500', 'border-blue-500');

                    if (updatedOrder.status === 'pending') {
                        statusSpan.classList.add('bg-gray-200', 'text-gray-800');
                        cardElement.classList.add('border-blue-500');
                    } else if (updatedOrder.status === 'preparing') {
                        statusSpan.classList.add('bg-yellow-200', 'text-yellow-800');
                        cardElement.classList.add('border-yellow-500');
                    } else if (updatedOrder.status === 'ready') {
                        statusSpan.classList.add('bg-green-200', 'text-green-800');
                        cardElement.classList.add('border-green-500');
                        readyButton.classList.remove('bg-purple-600', 'hover:bg-purple-700');
                        readyButton.classList.add('bg-green-500', 'cursor-not-allowed');
                        readyButton.textContent = 'Siap Disajikan';
                        readyButton.disabled = true;
                        readyButton.style.display = 'block'; // Ensure it's visible if it becomes ready
                    }

                    // Check if all items are made to show/enable the 'Mark Order Ready' button
                    const allItemsMade = updatedOrder.order_items.every(item => item.status === 'made');
                    if (allItemsMade && updatedOrder.status !== 'ready') {
                        readyButton.style.display = 'block';
                        readyButton.disabled = false;
                    } else if (updatedOrder.status !== 'ready') {
                        readyButton.style.display = 'none';
                    }
                }
            }

            // Event listener for "Mark Item Made" buttons
            ordersList.addEventListener('click', async function (event) {
                console.log('Click event detected on ordersList.', event.target);
                if (event.target.classList.contains('mark-item-made-btn')) {
                    const button = event.target;
                    const orderItemId = button.dataset.orderItemId;

                    try {
                        const response = await axios.post(`/koki/order-items/${orderItemId}/mark-made`);
                        if (response.data.message) {
                            console.log(response.data.message);
                            updateOrderItemUI(orderItemId, response.data.order_item_status);
                            updateOrderCardUI(response.data.order);
                            // Printing functionality removed as per user request.
                        }
                    } catch (error) {
                        console.error('Error marking item as made:', error);
                        alert('Gagal menandai item sebagai dibuat.');
                    }
                }
            });

            // Event listener for "Mark Order Ready" buttons
            ordersList.addEventListener('click', async function (event) {
                if (event.target.classList.contains('mark-order-ready-btn')) {
                    const button = event.target;
                    const orderId = button.dataset.orderId;

                    try {
                        const response = await axios.post(`/koki/orders/${orderId}/mark-ready`);
                        if (response.data.message) {
                            console.log(response.data.message);
                            updateOrderCardUI(response.data.order);
                        }
                    } catch (error) {
                        console.error('Error marking order as ready:', error);
                        alert('Gagal menandai pesanan sebagai siap.');
                    }
                }
            });

            // --- Real-time Updates with Laravel Echo ---
            window.Echo.channel('orders')
                .listen('.order.updated', (e) => {
                    console.log('Order updated via Echo:', e.order);
                    updateOrderCardUI(e.order.id, e.order.status);
                    // Optionally, re-render the entire card or move it if status changes significantly
                });

            window.Echo.channel('order-items')
                .listen('.order-item.updated', (e) => {
                    console.log('Order item updated via Echo:', e.order_item);
                    updateOrderItemUI(e.order_item.id, e.order_item.status);
                    updateOrderCardUI(e.order);
                });
            // --- Printing Function removed as per user request ---
        });
    </script>
</body>

</html>