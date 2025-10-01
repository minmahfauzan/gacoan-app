<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Status - Gacoan</title>
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #fef3e2;
        }

        @keyframes confetti {
            0% {
                transform: translateY(0) rotate(0deg);
                opacity: 1;
            }

            100% {
                transform: translateY(300px) rotate(720deg);
                opacity: 0;
            }
        }

        .confetti {
            position: absolute;
            width: 10px;
            height: 10px;
            top: 0;
            left: 50%;
            animation: confetti 3s linear infinite;
        }
    </style>
</head>

<body class="min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="text-center mb-10">
            <h1 class="text-3xl font-bold text-red-600 mb-2">ORDER STATUS</h1>
            <p class="text-gray-600">Order #{{ $order->order_number }}</p>
        </div>

        <!-- Status Timeline -->
        <div class="bg-white rounded-2xl shadow-xl p-2 pt-7 mb-10 relative overflow-hidden">
            <div class="flex flex-row items-center justify-between gap-1 md:gap-6 relative">
                @php
                    $steps = [
                        'pending' => ['label' => 'Pending', 'icon' => 'M9 H7a2...'],
                        'preparing' => ['label' => 'Preparing', 'icon' => 'M12 8v4...'],
                        'ready' => ['label' => 'Ready', 'icon' => 'M5 13l4...'],
                        'served' => ['label' => 'Served', 'icon' => 'M5 13l4...'],
                    ];
                    $statuses = array_keys($steps);
                    $currentIndex = array_search($order->status, $statuses);
                @endphp

                @foreach ($steps as $key => $step)
                    @php
                        $index = array_search($key, $statuses);
                        $isActive = $index === $currentIndex;
                        $isCompleted = $index < $currentIndex;
                        $isServed = $order->status === 'served' && $key === 'served';
                    @endphp

                    <div class="flex flex-col items-center relative min-w-[80px] flex-1">
                        <!-- Icon -->
                        <div
                            class="w-[clamp(2.5rem,11vw,3.5rem)] h-[clamp(2.5rem,11vw,3.5rem)]   flex items-center justify-center rounded-full shadow-lg transition-all duration-500
              {{ $isServed
                  ? 'bg-green-500 text-white animate-bounce'
                  : ($isCompleted
                      ? 'bg-green-500 text-white'
                      : ($isActive
                          ? 'bg-gradient-to-r from-red-500 to-orange-500 text-white animate-pulse'
                          : 'bg-gray-200 text-gray-500')) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="{{ $step['icon'] }}" />
                            </svg>
                        </div>
                        <!-- Label -->
                        <p
                            class="mt-3 font-semibold text-sm whitespace-nowrap {{ $isActive ? 'text-red-600' : 'text-gray-500' }}">
                            {{ $step['label'] }}
                        </p>

                        <!-- Connector -->
                        @if (!$loop->last)
                            <div
                                class="absolute top-7 left-[55%] w-full h-1 transition-all duration-500 z-[-1]
                {{ $isCompleted ? 'bg-gradient-to-r from-red-500 to-orange-500' : 'bg-gray-200' }}">
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>

            <!-- Confetti jika Served -->
            @if ($order->status === 'served')
                <div class="absolute inset-0 pointer-events-none">
                    @for ($i = 0; $i < 20; $i++)
                        <div class="confetti"
                            style="
              left: {{ rand(5, 95) }}%;
              background: hsl({{ rand(0, 360) }}, 80%, 60%);
              animation-delay: {{ rand(0, 2000) }}ms;">
                        </div>
                    @endfor
                </div>
            @endif
        </div>

        <!-- Status Info -->
        <div class="bg-white rounded-2xl shadow-md p-6 mb-10 text-center">
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
                        Order Served 🎉
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

        <!-- Order Details -->
        <div class="bg-white rounded-2xl shadow-md p-6 mb-10">
            <h3 class="text-xl font-bold text-gray-800 mb-4">Order Details</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Items -->
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
                <!-- Info -->
                <div>
                    <h4 class="font-semibold text-gray-700 mb-2">Order Information</h4>
                    <div class="space-y-2 text-sm">
                        <div class="flex"><span class="w-32 text-gray-600">Order Number:</span><span
                                class="font-medium">{{ $order->order_number }}</span></div>
                        <div class="flex"><span class="w-32 text-gray-600">Table:</span><span
                                class="font-medium">{{ $order->table->table_number }}</span></div>
                        <div class="flex"><span class="w-32 text-gray-600">Nama Pemesan:</span><span
                                class="font-medium">{{ $order->nama_pemesan }}</span></div>
                        @if ($order->keterangan)
                            <div class="flex"><span class="w-32 text-gray-600">Keterangan:</span><span
                                    class="font-medium">{{ $order->keterangan }}</span></div>
                        @endif
                        <div class="flex"><span class="w-32 text-gray-600">Status:</span><span
                                class="font-medium capitalize">{{ $order->status }}</span></div>
                        <div class="flex"><span class="w-32 text-gray-600">Ordered
                                At:</span><span>{{ $order->created_at->format('d M Y, H:i') }}</span></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Back Button -->
        <div class="text-center">
            <a href="{{ route('menu.index') }}"
                class="inline-block bg-red-600 hover:bg-red-700 text-white font-medium py-3 px-6 rounded-lg transition shadow-md">
                Back to Menu
            </a>
        </div>
    </div>

    <!-- Auto-refresh -->
    {{-- <script>
        setTimeout(() => location.reload(), 30000);
    </script> --}}
</body>

</html>
