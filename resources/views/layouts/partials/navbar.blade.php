<!-- Main Header -->
<header class="bg-white shadow-sm sticky top-0 z-20">
    <div class="container mx-auto px-4 py-3 flex justify-between items-center">
        <!-- Logo and Table Number -->
        <a href="{{ route('menu.index') }}" class="flex items-center">
            <h1 class="text-2xl font-bold text-red-600">GACOAN</h1>
            @if(Session::has('table_number'))
            <span class="ml-4 bg-red-100 text-red-800 text-sm font-medium px-2.5 py-0.5 rounded hidden md:block">
                Meja No: {{ Session::get('table_number') }}
            </span>
            @endif
        </a>
        
        <!-- Desktop Navbar -->
        <nav class="hidden md:flex items-center space-x-4">
            <a href="{{ route('cart.index') }}" class="relative p-2 text-gray-600 hover:text-red-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                @php $cartCount = array_sum(array_column(session('cart', []), 'quantity')); @endphp
                <span id="cart-count-desktop" class="absolute top-0 right-0 bg-yellow-400 text-red-600 text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center @if($cartCount == 0) hidden @endif">
                    {{ $cartCount }}
                </span>
            </a>
            @if(Session::has('table_number'))
            <form action="{{ route('table.auth.logout') }}" method="POST">
                @csrf
                <button type="submit" class="text-gray-600 hover:text-red-600 transition" title="Logout">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                </button>
            </form>
            @endif
        </nav>

        <!-- Mobile Menu Button -->
        <div class="md:hidden">
            <button id="mobile-menu-button" class="text-gray-600 hover:text-red-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>
        </div>
    </div>
</header>

<!-- Mobile Sidebar -->
<div id="mobile-sidebar" class="fixed inset-0 bg-black bg-opacity-50 z-30 hidden">
    <div id="sidebar-content" class="fixed top-0 left-0 h-full w-64 bg-white shadow-xl p-6 transform -translate-x-full transition-transform duration-300 ease-in-out">
        <h2 class="text-xl font-bold text-red-600 mb-6">Menu</h2>
        <nav class="flex flex-col space-y-4">
            <a href="{{ route('cart.index') }}" class="flex items-center text-gray-700 hover:text-red-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                <span>Keranjang</span>
                <span id="cart-count-mobile" class="ml-auto bg-yellow-400 text-red-600 text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center @if($cartCount == 0) hidden @endif">
                    {{ $cartCount }}
                </span>
            </a>
            @if(Session::has('table_number'))
            <form action="{{ route('table.auth.logout') }}" method="POST" class="w-full">
                @csrf
                <button type="submit" class="w-full flex items-center text-gray-700 hover:text-red-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                    <span>Logout</span>
                </button>
            </form>
            @endif
        </nav>

        <!-- Category Filters -->
        <div class="border-t my-6"></div>
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Kategori</h3>
        <nav class="flex flex-col space-y-2">
            <button class="category-btn active text-left w-full p-2 rounded-md bg-red-600 text-white" data-category="all">All</button>
            @foreach($categories as $category)
                <button class="category-btn text-left w-full p-2 rounded-md" data-category="{{ $category->id }}">{{ $category->name }}</button>
            @endforeach
        </nav>
    </div>
</div>