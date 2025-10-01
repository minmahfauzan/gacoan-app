<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel - Gacoan')</title>
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f9fafb;
        }

        .sidebar {
            transition: all 0.3s ease;
        }

        .sidebar.collapsed {
            width: 80px;
        }

        .sidebar.expanded {
            width: 250px;
        }

        .nav-link:hover {
            background-color: #fef2f2;
        }

        .nav-link.active {
            background-color: #fef2f2;
            color: #dc2626;
            border-right: 4px solid #dc2626;
        }
    </style>
</head>

<body class="min-h-screen flex">
    <!-- Sidebar -->
    <aside id="sidebar" class="sidebar expanded bg-white shadow-md h-screen sticky top-0 overflow-y-auto">
        <div class="p-4 border-b">
            <h1 class="text-xl font-bold text-red-600 truncate">GACOAN ADMIN</h1>
        </div>

        <nav class="py-4">
            <a href="{{ route('admin.dashboard') }}"
                class="nav-link flex items-center px-4 py-3 text-gray-700 hover:text-red-600 {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                <span class="sidebar-text">Dashboard</span>
            </a>

            <a href="{{ route('admin.orders.index') }}"
                class="nav-link flex items-center px-4 py-3 text-gray-700 hover:text-red-600 {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
                <span class="sidebar-text">Orders</span>
            </a>

            <a href="{{ route('admin.products.index') }}"
                class="nav-link flex items-center px-4 py-3 text-gray-700 hover:text-red-600 {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
                <span class="sidebar-text">Products</span>
            </a>

            <a href="{{ route('admin.tables.qrcodes') }}"
                class="nav-link flex items-center px-4 py-3 text-gray-700 hover:text-red-600 {{ request()->routeIs('admin.tables.qrcodes') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                <span class="sidebar-text">Table QR Codes</span>
            </a>
        </nav>

        <div class="absolute bottom-0 left-0 right-0 p-4 border-t">
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit"
                    class="nav-link flex items-center w-full px-4 py-3 text-gray-700 hover:text-red-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    <span class="sidebar-text">Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">
        <!-- Top Bar -->
        <header class="bg-white shadow-sm">
            <div class="flex items-center justify-between p-4">
                <button id="toggle-sidebar" class="text-gray-500 hover:text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

                <div class="flex items-center">
                    <span class="text-gray-700 mr-4">Admin</span>
                    <div class="w-8 h-8 rounded-full bg-red-600 flex items-center justify-center text-white font-bold">
                        A
                    </div>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <main class="flex-1 p-6">
            @if (session('success'))
                <div id="success-alert"
                    class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded-md shadow-md flex justify-between items-center">
                    <span>{{ session('success') }}</span>
                    <button onclick="document.getElementById('success-alert').style.display='none'"
                        class="text-green-700 hover:text-green-900">&times;</button>
                </div>
            @endif
            @yield('content')
        </main>
    </div>

    <script>
        $(document).ready(function() {
            $('#toggle-sidebar').click(function() {
                $('#sidebar').toggleClass('collapsed expanded');
                $('.sidebar-text').toggle();
            });
        });
    </script>

    @yield('scripts')
</body>

</html>
