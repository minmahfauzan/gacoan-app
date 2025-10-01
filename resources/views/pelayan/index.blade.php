<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pelayan Dashboard</title>

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
        .notification-message {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #4CAF50;
            color: white;
            padding: 15px 25px;
            border-radius: 8px;
            font-size: 1.2em;
            z-index: 1000;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            display: none;
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
        }
        .notification-message.show {
            display: block;
            opacity: 1;
        }
    </style>
</head>

<body class="min-h-screen flex flex-col">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Daftar Pesanan Siap Disajikan</h1>

        <div id="orders-list" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($orders as $order)
                <div id="order-card-{{ $order->id }}" class="bg-white shadow-lg rounded-lg p-6 border-t-4 border-green-500">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-semibold">Pesanan #{{ $order->order_number }}</h2>
                        <span class="px-3 py-1 rounded-full text-sm font-medium bg-green-200 text-green-800">
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
                            <li class="flex justify-between items-center p-3 rounded-md bg-gray-50">
                                <div>
                                    <span class="font-medium">{{ $item->product->name }}</span>
                                    <span class="text-gray-500"> (x{{ $item->quantity }})</span>
                                </div>
                            </li>
                        @endforeach
                    </ul>

                    <div class="flex justify-between mt-4">
                        <button data-order-id="{{ $order->id }}" data-table-number="{{ $order->table->table_number }}"
                                class="audio-notify-btn px-4 py-2 rounded-md bg-blue-600 text-white font-semibold hover:bg-blue-700">
                            <i class="fas fa-volume-up mr-2"></i> Umumkan
                        </button>
                        <button data-order-id="{{ $order->id }}"
                                class="mark-order-served-btn px-4 py-2 rounded-md bg-green-600 text-white font-semibold hover:bg-green-700">
                            Tandai Disajikan
                        </button>
                    </div>
                </div>
            @empty
                <p class="text-gray-600">Tidak ada pesanan yang siap disajikan.</p>
            @endforelse
        </div>
    </div>

    <div id="notification-display" class="notification-message"></div>

    <audio id="notification-audio" src="/audio/notification.mp3" preload="auto"></audio> <!-- Placeholder for audio file -->

    <script type="module">
        // Laravel Echo setup is in bootstrap.js, so it should be available globally
        // window.Echo

        document.addEventListener('DOMContentLoaded', function () {
            const ordersList = document.getElementById('orders-list');
            const notificationDisplay = document.getElementById('notification-display');
            const notificationAudio = document.getElementById('notification-audio');

            // Function to update order card status in UI (remove card if served)
            function updateOrderCardUI(updatedOrder) {
                const cardElement = document.getElementById(`order-card-${updatedOrder.id}`);
                if (cardElement) {
                    if (updatedOrder.status === 'served') {
                        cardElement.remove(); // Remove card when served
                        if (ordersList.children.length === 0) {
                            ordersList.innerHTML = '<p class="text-gray-600">Tidak ada pesanan yang siap disajikan.</p>';
                        }
                    } else if (updatedOrder.status === 'ready') {
                        // If an order becomes ready, and it's not already displayed, add it.
                        // For simplicity, we'll just ensure it's visible and correctly styled.
                        // A more complex solution might involve re-fetching the list or dynamically adding the card.
                        // For now, we assume the initial load handles existing 'ready' orders.
                        // If an order changes from 'preparing' to 'ready' via Echo, it should appear here.
                        // This part might need refinement if orders don't appear dynamically.
                        console.log('Order became ready:', updatedOrder);
                        // You might want to re-fetch the entire list or dynamically add the card here
                        // if the order was not initially in the 'ready' state on page load.
                    }
                }
            }

            // Event listener for "Audio Notify" buttons
            ordersList.addEventListener('click', async function (event) {
                if (event.target.classList.contains('audio-notify-btn')) {
                    const button = event.target;
                    const orderId = button.dataset.orderId;
                    const tableNumber = button.dataset.tableNumber;

                    const message = `Pesanan meja ${tableNumber} sudah siap!`;
                    notificationDisplay.textContent = message;
                    notificationDisplay.classList.add('show');

                    if (notificationAudio) {
                        notificationAudio.play();
                    }

                    setTimeout(() => {
                        notificationDisplay.classList.remove('show');
                    }, 5000); // Display for 5 seconds

                    console.log(`Audio notification for Order ${orderId}, Table ${tableNumber}`);
                }
            });

            // Event listener for "Mark Order Served" buttons
            ordersList.addEventListener('click', async function (event) {
                if (event.target.classList.contains('mark-order-served-btn')) {
                    const button = event.target;
                    const orderId = button.dataset.orderId;

                    try {
                        const response = await axios.post(`/pelayan/orders/${orderId}/mark-served`);
                        if (response.data.message) {
                            console.log(response.data.message);
                            updateOrderCardUI(response.data.order);
                        }
                    } catch (error) {
                        console.error('Error marking order as served:', error);
                        alert('Gagal menandai pesanan sebagai disajikan.');
                    }
                }
            });

            // --- Real-time Updates with Laravel Echo ---
            window.Echo.channel('orders')
                .listen('.order.updated', (e) => {
                    console.log('Pelayan: Order updated via Echo:', e.order);
                    updateOrderCardUI(e.order);
                });

            // We don't need to listen for order-item.updated here as pelayan only cares about overall order status
        });
    </script>
</body>

</html>
