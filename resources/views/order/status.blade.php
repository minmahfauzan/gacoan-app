<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Status - Gacoan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #fef3e2;
        }

        .status-step {
            transition: all 0.3s ease;
        }

        .status-active {
            background-color: #dc2626;
            color: white;
        }

        .status-completed {
            background-color: #10b981;
            color: white;
        }
    </style>
</head>

<body class="min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-red-600 mb-2">ORDER STATUS INI</h1>
            <p class="text-gray-600">Order #{{ $order->order_number }}</p>
        </div>

        <!-- Order Status Progress -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-8">
            <div class="flex justify-between items-center mb-8">
                <div
                    class="text-center status-step {{ $order->status == 'pending' || $order->status == 'preparing' || $order->status == 'ready' || $order->status == 'served' ? 'status-active' : '' }}">
                    <div
                        class="w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-2 {{ $order->status == 'pending' || $order->status == 'preparing' || $order->status == 'ready' || $order->status == 'served' ? 'status-active' : 'bg-gray-200' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <p class="font-medium">Pending</p>
                </div>

                <div
                    class="flex-1 h-1 mx-2 {{ $order->status == 'preparing' || $order->status == 'ready' || $order->status == 'served' ? 'bg-red-600' : 'bg-gray-200' }}">
                </div>

                <div
                    class="text-center status-step {{ $order->status == 'preparing' || $order->status == 'ready' || $order->status == 'served' ? 'status-active' : '' }}">
                    <div
                        class="w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-2 {{ $order->status == 'preparing' || $order->status == 'ready' || $order->status == 'served' ? 'status-active' : 'bg-gray-200' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <p class="font-medium">Preparing</p>
                </div>

                <div
                    class="flex-1 h-1 mx-2 {{ $order->status == 'ready' || $order->status == 'served' ? 'bg-red-600' : 'bg-gray-200' }}">
                </div>

                <div
                    class="text-center status-step {{ $order->status == 'ready' || $order->status == 'served' ? 'status-active' : '' }}">
                    <div
                        class="w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-2 {{ $order->status == 'ready' || $order->status == 'served' ? 'status-active' : 'bg-gray-200' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <p class="font-medium">Ready</p>
                </div>

                <div class="flex-1 h-1 mx-2 {{ $order->status == 'served' ? 'bg-red-600' : 'bg-gray-200' }}"></div>

                <div class="text-center status-step {{ $order->status == 'served' ? 'status-completed' : '' }}">
                    <div
                        class="w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-2 {{ $order->status == 'served' ? 'status-completed' : 'bg-gray-200' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <p class="font-medium">Served</p>
                </div>
            </div>

            <div class="text-center">
                <h2 class="text-2xl font-bold mb-2">
                    @switch($order->status)
                        @case('pending')
                            Order Received
                        @break

                        @case('preparing')
                            Order is Being Prepared
                        @break

                        @case('ready')
                            Order is Ready for Pickup
                        @break

                        @case('served')
                            Order Served
                        @break

                        @default
                            Order Status Unknown
                    @endswitch
                </h2>
                <p class="text-gray-600">
                    @switch($order->status)
                        @case('pending')
                            Your order has been received and will be prepared shortly.
                        @break

                        @case('preparing')
                            Our chefs are preparing your delicious meal right now.
                        @break

                        @case('ready')
                            Your order is ready! Please come to the counter to pick it up.
                        @break

                        @case('served')
                            Enjoy your meal! Thank you for choosing Gacoan.
                        @break
                    @endswitch
                </p>
            </div>
        </div>

        <!-- Order Details -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-8">
            <h3 class="text-xl font-bold text-gray-800 mb-4">Order Details</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h4 class="font-semibold text-gray-700 mb-2">Items Ordered</h4>
                    <ul class="space-y-2">
                        @foreach ($order->orderItems as $item)
                            <li class="flex justify-between border-b pb-2">
                                <span>{{ $item->product->name }} <span
                                        class="text-gray-500">x{{ $item->quantity }}</span></span>
                                <span>Rp{{ number_format($item->total, 0, ',', '.') }}</span>
                            </li>
                        @endforeach
                    </ul>

                    <div class="flex justify-between font-bold text-lg mt-4 pt-2 border-t">
                        <span>Total</span>
                        <span>Rp{{ number_format($order->total_amount, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div>
                    <h4 class="font-semibold text-gray-700 mb-2">Order Information</h4>
                    <div class="space-y-2">
                        <div class="flex">
                            <span class="w-32 text-gray-600">Order Number:</span>
                            <span class="font-medium">{{ $order->order_number }}</span>
                        </div>
                        <div class="flex">
                            <span class="w-32 text-gray-600">Table:</span>
                            <span class="font-medium">{{ $order->table->table_number }}</span>
                        </div>
                        <div class="flex">
                            <span class="w-32 text-gray-600">Status:</span>
                            <span class="font-medium capitalize">{{ $order->status }}</span>
                        </div>
                        <div class="flex">
                            <span class="w-32 text-gray-600">Ordered At:</span>
                            <span>{{ $order->created_at->format('d M Y, H:i') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center">
            <a href="{{ route('menu.index') }}"
                class="inline-block bg-red-600 hover:bg-red-700 text-white font-medium py-3 px-6 rounded-lg transition">
                Back to Menu
            </a>
        </div>
    </div>

    <!-- Auto-refresh script -->
    <script>
        // Refresh the page every 30 seconds to check for status updates
        setTimeout(function() {
            location.reload();
        }, 30000);
    </script>
</body>

</html>
