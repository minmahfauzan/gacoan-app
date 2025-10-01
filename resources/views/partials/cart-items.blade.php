@if (count($cart) > 0)
    <!-- Desktop view -->
    <div class="hidden sm:block overflow-x-auto">
        <table class="min-w-full border-collapse">
            <thead>
                <tr>
                    <th class="text-left py-2 px-2">Produk</th>
                    <th class="text-center py-2 px-2">Jumlah</th>
                    <th class="text-right py-2 px-2">Harga</th>
                    <th class="text-right py-2 px-2">Subtotal</th>
                    <th class="text-center py-2 px-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cart as $id => $details)
                    <tr id="row-{{ $id }}" class="border-b">
                        <td class="py-4 px-2">{{ $details['name'] }}</td>
                        <td class="py-4 text-center px-2">
                            <div class="flex items-center justify-center">
                                <button class="quantity-btn bg-gray-200 px-2 rounded-l"
                                    data-product-id="{{ $id }}" data-change="-1">-</button>
                                <span class="px-4 quantity-span">{{ $details['quantity'] }}</span>
                                <button class="quantity-btn bg-gray-200 px-2 rounded-r"
                                    data-product-id="{{ $id }}" data-change="1">+</button>
                            </div>
                        </td>
                        <td class="py-4 text-right px-2">
                            Rp {{ number_format($details['price'], 0, ',', '.') }}
                        </td>
                        <td class="py-4 text-right px-2 subtotal">
                            Rp {{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}
                        </td>
                        <td class="py-4 text-center px-2">
                            <button
                                class="remove-item-btn bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded"
                                data-product-id="{{ $id }}">
                                Hapus
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Mobile view -->
    <div class="block sm:hidden space-y-4">
        @foreach ($cart as $id => $details)
            <div id="row-{{ $id }}" class="bg-gray-50 shadow rounded-lg p-4">
                <div class="font-bold text-lg">{{ $details['name'] }}</div>
                <div class="flex justify-between text-sm text-gray-600 mt-1">
                    <span>Harga</span>
                    <span>Rp {{ number_format($details['price'], 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between items-center mt-2">
                    <div class="flex items-center">
                        <button class="quantity-btn bg-gray-200 px-2 rounded-l" data-product-id="{{ $id }}"
                            data-change="-1">-</button>
                        <span class="px-4 quantity-span">{{ $details['quantity'] }}</span>
                        <button class="quantity-btn bg-gray-200 px-2 rounded-r" data-product-id="{{ $id }}"
                            data-change="1">+</button>
                    </div>
                    <span class="font-semibold text-red-600 subtotal">
                        Rp {{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}
                    </span>
                </div>
                <div class="mt-3 text-right">
                    <button
                        class="remove-item-btn bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded text-sm"
                        data-product-id="{{ $id }}">
                        Hapus
                    </button>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Total -->
    <div class="text-right mt-6">
        <h2 class="text-xl sm:text-2xl font-bold">
            Total: <span id="cart-total">Rp {{ number_format($total, 0, ',', '.') }}</span>
        </h2>
    </div>
@else
    <p class="text-center text-gray-500">Keranjang Anda kosong.</p>
@endif
