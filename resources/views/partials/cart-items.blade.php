@if(count($cart) > 0)
    <table class="min-w-full">
        <thead>
            <tr>
                <th class="text-left py-2">Produk</th>
                <th class="text-center py-2">Jumlah</th>
                <th class="text-right py-2">Harga</th>
                <th class="text-right py-2">Subtotal</th>
                <th class="text-center py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cart as $id => $details)
                <tr id="row-{{ $id }}">
                    <td class="py-4">{{ $details['name'] }}</td>
                    <td class="py-4 text-center">
                        <div class="flex items-center justify-center">
                            <button class="quantity-btn bg-gray-200 px-2 rounded-l" data-product-id="{{ $id }}" data-change="-1">-</button>
                            <span class="px-4 quantity-span">{{ $details['quantity'] }}</span>
                            <button class="quantity-btn bg-gray-200 px-2 rounded-r" data-product-id="{{ $id }}" data-change="1">+</button>
                        </div>
                    </td>
                    <td class="py-4 text-right">Rp {{ number_format($details['price'], 0, ',', '.') }}</td>
                    <td class="py-4 text-right subtotal">Rp {{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}</td>
                    <td class="py-4 text-center">
                        <button class="remove-item-btn bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded" data-product-id="{{ $id }}">
                            Hapus
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="text-right mt-8">
        <h2 class="text-2xl font-bold">Total: <span id="cart-total">Rp {{ number_format($total, 0, ',', '.') }}</span></h2>
    </div>
@else
    <p class="text-center text-gray-500">Keranjang Anda kosong.</p>
@endif
