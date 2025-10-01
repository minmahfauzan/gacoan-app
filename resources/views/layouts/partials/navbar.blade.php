<!-- Main Header -->
<header class="bg-red-600 shadow-lg sticky top-0 z-20">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">
            <!-- Logo and Table Number -->
            <div class="flex-shrink-0">
                <a href="{{ route('menu.index') }}" class="flex items-baseline">
                    <h1 class="text-3xl font-extrabold text-white tracking-tight">GACOAN</h1>
                    @if(Session::has('table_number'))
                        <span class="ml-3 bg-white text-red-600 text-sm font-semibold px-3 py-1 rounded-full">
                            Meja {{ Session::get('table_number') }}
                        </span>
                    @endif
                </a>
            </div>

            <!-- Desktop Navbar -->
            <nav class="hidden md:flex md:items-center md:space-x-6">
                <a href="{{ route('cart.index') }}" class="relative text-white hover:text-gray-200 transition">
                    <svg class="h-7 w-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    @php $cartCount = array_sum(array_column(session('cart', []), 'quantity')); @endphp
                    <span id="cart-count-desktop" class="absolute -top-2 -right-2 bg-yellow-400 text-red-600 text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center @if($cartCount == 0) hidden @endif">
                        {{ $cartCount }}
                    </span>
                </a>
                @if(Session::has('table_number'))
                    <form action="{{ route('table.auth.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-white hover:text-gray-200 transition" title="Logout">
                            <svg class="h-7 w-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                        </button>
                    </form>
                @endif
            </nav>

            <!-- Mobile Menu Button -->
            <div class="-mr-2 flex items-center md:hidden">
                <button id="mobile-menu-button" class="inline-flex items-center justify-center p-2 rounded-md text-white hover:text-gray-200 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
                    <span class="sr-only">Open main menu</span>
                    <svg id="menu-open-icon" class="h-7 w-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg id="menu-close-icon" class="h-7 w-7 hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Sidebar -->
    <div id="mobile-sidebar-container" class="fixed inset-0 z-30 md:hidden hidden">
        <!-- Overlay -->
        <div id="mobile-sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50"></div>

        <!-- Sidebar -->
        <div id="mobile-sidebar" class="relative h-full w-64 bg-white shadow-xl p-6 transform -translate-x-full transition-transform duration-300 ease-in-out">
            <button id="mobile-sidebar-close-button" class="absolute top-4 right-4 text-gray-500 hover:text-gray-800">
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <a href="{{ route('cart.index') }}" class="flex items-center text-base font-medium text-gray-600 hover:text-red-600 hover:bg-gray-50 p-2 rounded-md">
                    <svg class="h-6 w-6 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <span>Keranjang</span>
                    @php $cartCount = array_sum(array_column(session('cart', []), 'quantity')); @endphp
                    <span id="cart-count-mobile" class="ml-auto bg-yellow-400 text-red-600 text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center @if($cartCount == 0) hidden @endif">
                        {{ $cartCount }}
                    </span>
                </a>
                @if(Session::has('table_number'))
                    <form action="{{ route('table.auth.logout') }}" method="POST" class="w-full">
                        @csrf
                        <button type="submit" class="w-full flex items-center text-base font-medium text-gray-600 hover:text-red-600 hover:bg-gray-50 p-2 rounded-md">
                            <svg class="h-6 w-6 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            <span>Logout</span>
                        </button>
                    </form>
                @endif
            </div>
            <div class="border-t border-gray-200 pt-4 pb-3">
                <h3 class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Kategori</h3>
                <div class="mt-3 space-y-1" role="menu" aria-orientation="vertical" aria-labelledby="user-menu">
                    <button class="category-btn active w-full text-left block px-3 py-1 text-sm font-medium text-gray-900 bg-gray-100" data-category="all">All</button>
                    @foreach($categories as $category)
                        <button class="category-btn w-full text-left block px-3 py-1 text-sm font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-50" data-category="{{ $category->id }}">{{ $category->name }}</button>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileSidebarContainer = document.getElementById('mobile-sidebar-container');
        const mobileSidebar = document.getElementById('mobile-sidebar');
        const mobileSidebarOverlay = document.getElementById('mobile-sidebar-overlay');
        const mobileSidebarCloseButton = document.getElementById('mobile-sidebar-close-button');
        const categoryButtons = document.querySelectorAll('#mobile-sidebar .category-btn');

        function openSidebar() {
            mobileSidebarContainer.classList.remove('hidden');
            setTimeout(() => {
                mobileSidebar.classList.remove('-translate-x-full');
            }, 50);
        }

        function closeSidebar() {
            mobileSidebar.classList.add('-translate-x-full');
            setTimeout(() => {
                mobileSidebarContainer.classList.add('hidden');
            }, 300);
        }

        mobileMenuButton.addEventListener('click', openSidebar);
        mobileSidebarOverlay.addEventListener('click', closeSidebar);
        mobileSidebarCloseButton.addEventListener('click', closeSidebar);

        categoryButtons.forEach(button => {
            button.addEventListener('click', function () {
                closeSidebar();
            });
        });
    });
</script>