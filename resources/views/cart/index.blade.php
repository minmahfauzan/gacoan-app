@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-center mb-8">Keranjang Belanja Anda</h1>

    <div id="cart-container" class="bg-white shadow-lg rounded-lg p-6">
        <!-- Konten keranjang akan dimuat oleh JavaScript -->
        <div id="cart-items-wrapper">
            @include('partials.cart-items', ['cart' => $cart, 'total' => $total])
        </div>

        <div class="text-right mt-4">
            <a href="{{ route('menu.index') }}" class="text-blue-500 hover:underline mr-4">Lanjut Belanja</a>
            @if(count($cart) > 0)
                <form action="{{ route('order.store') }}" method="POST" class="inline-block">
                    @csrf
                    <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg text-xl">
                        Place Order
                    </button>
                </form>
            @endif
        </div>
    </div>
</div>
@endsection
