@extends('layouts.app')

@section('content')
    <main class="container mx-auto px-4 py-6">
        <!-- Category Filter -->
        <div class="sticky top-20 bg-white z-10 py-3 mb-6 shadow-md">
            <div class="overflow-x-auto">
                <div class="flex space-x-3 w-max mx-auto sm:mx-0 px-2">
                    <button data-category="all"
                        class="category-btn active px-4 py-2 rounded-full text-sm font-medium text-white bg-red-600 shadow whitespace-nowrap">

                        All
                    </button>
                    @foreach ($categories as $category)
                        <button
                            class="category-btn px-4 py-2 rounded-full text-sm font-medium text-gray-700 bg-gray-100 hover:bg-red-100 hover:text-red-600 transition whitespace-nowrap"
                            data-category="{{ $category->id }}">
                            {{ $category->name }}
                        </button>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Notifikasi Sukses -->
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @foreach ($categories as $category)
            <div id="category-{{ $category->id }}" class="category-group mb-12">
                <h2 class="text-3xl font-bold mb-6 text-gray-800 border-l-4 border-red-600 pl-4">{{ $category->name }}</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($category->products as $product)
                        <div class="product-card bg-white rounded-xl shadow-md overflow-hidden transition-all duration-300 hover:shadow-xl p-4 flex flex-col relative {{ !$product->is_active ? 'grayscale' : '' }}"
                            data-category-id="{{ $product->category_id }}">
                            
                            @if(!$product->is_active)
                                <div class="absolute inset-0 bg-white bg-opacity-50 flex items-center justify-center z-10">
                                    <span class="bg-red-600 text-white font-bold py-2 px-4 rounded-lg">Barang Habis</span>
                                </div>
                            @endif

                            <div class="relative mb-4">
                                @if ($product->image)
                                    <img src="{{ route('products.image', ['filename' => basename($product->image)]) }}" alt="{{ $product->name }}" class="w-full h-40 object-cover rounded-lg">
                                @else
                                    <img src="https://placehold.co/600x400.png" alt="{{ $product->name }}" class="w-full h-40 object-cover rounded-lg">
                                @endif                            </div>

                            <div class="flex-grow">
                                <h3 class="font-bold text-lg mb-1">{{ $product->name }}</h3>
                                <p class="text-gray-600 text-sm mb-3 h-10">{{ Str::limit($product->description, 60) }}</p>
                                <span
                                    class="font-bold text-red-600 text-lg">Rp{{ number_format($product->price, 0, ',', '.') }}</span>
                            </div>
                            <div class="mt-4">
                                <div class="flex items-center">
                                    @if($product->is_active)
                                        <label for="quantity-{{ $product->id }}" class="mr-2 text-sm sr-only">Jumlah:</label>
                                        <input type="number" id="quantity-{{ $product->id }}" name="quantity" value="1"
                                            min="1" class="w-16 text-center border rounded-md quantity-input">
                                        <button type="button"
                                            class="add-to-cart-btn ml-auto bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm transition font-medium"
                                            data-product-id="{{ $product->id }}" data-product-name="{{ $product->name }}">
                                            + Keranjang
                                        </button>
                                    @else
                                        <button type="button" class="w-full bg-gray-300 text-gray-500 px-4 py-2 rounded-lg text-sm cursor-not-allowed">
                                            Habis
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </main>
@endsection
