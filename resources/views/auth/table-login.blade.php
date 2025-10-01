<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gacoan - Table Login</title>
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #fef3e2;
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-xl p-8 w-full max-w-md">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-red-600">GACOAN</h1>
            <p class="text-gray-600 mt-2">Login with your table number</p>
        </div>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('table.auth.login') }}" method="POST">
            @csrf
            <div class="mb-6">
                <label for="table_number" class="block text-gray-700 text-sm font-bold mb-2">
                    Table Number
                </label>
                <input type="text" id="table_number" name="table_number"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition"
                    placeholder="Enter your table number" required>
            </div>

            <button type="submit"
                class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-4 rounded-lg transition duration-300 transform hover:scale-105">
                Enter Restaurant
            </button>
        </form>

        <div class="mt-8 text-center">
            <p class="text-gray-500 text-sm">
                Scan QR code or ask staff for assistance
            </p>
        </div>
    </div>
</body>

</html>
