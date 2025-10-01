<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Gacoan App')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #fef3e2;
        }
    </style>
</head>

<body class="min-h-screen flex flex-col">
    <div id="notification-banner" class="hidden bg-green-500 text-white text-center py-2 fixed top-0 w-full z-50"></div>
    @include('layouts.partials.navbar')
    <div class="flex-grow">
        @yield('content')
    </div>
    @yield('scripts')
</body>

</html>
