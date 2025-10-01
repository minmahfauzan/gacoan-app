@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl sm:text-3xl font-bold text-center mb-6">Keranjang Belanja Anda</h1>

        <div id="cart-container" class="bg-white shadow-lg rounded-lg p-4 sm:p-6">
            <!-- Konten keranjang -->
            <div id="cart-items-wrapper">
                @include('partials.cart-items', ['cart' => $cart, 'total' => $total])
            </div>

            <div class="flex flex-col sm:flex-row justify-between items-center mt-6 gap-4">
                <a href="{{ route('menu.index') }}" class="text-blue-500 hover:underline order-2 sm:order-1">
                    ← Lanjut Belanja
                </a>

                @if (count($cart) > 0)
                    <form action="{{ route('order.store') }}" method="POST" class="w-full order-1 sm:order-2">
                        @csrf
                        <div class="mb-4">
                            <label for="nama_pemesan" class="block text-gray-700 text-sm font-bold mb-2">Nama Pemesan:</label>
                            <input type="text" name="nama_pemesan" id="nama_pemesan" value="{{ old('nama_pemesan') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('nama_pemesan') border-red-500 @enderror" required>
                            @error('nama_pemesan')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="keterangan" class="block text-gray-700 text-sm font-bold mb-2">Keterangan (Opsional):</label>
                            <textarea name="keterangan" id="keterangan" rows="3" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('keterangan') border-red-500 @enderror">{{ old('keterangan') }}</textarea>
                            @error('keterangan')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit"
                            class="w-full sm:w-auto bg-green-500 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg text-lg sm:text-xl">
                            Place Order
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection
