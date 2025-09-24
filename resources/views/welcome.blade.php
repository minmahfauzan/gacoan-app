<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Gacoan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #fef3e2;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center">
    <div class="text-center">
        <h1 class="text-5xl font-bold text-red-600 mb-4">GACOAN</h1>
        <p class="text-xl text-gray-700 mb-8">Authentic Indonesian Spicy Food Experience</p>
        <a href="{{ route('table.auth.login') }}" class="bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-6 rounded-full text-lg transition duration-300 transform hover:scale-105">
            Enter Restaurant
        </a>
        <div class="mt-8">
            <p class="text-gray-600">Please scan the QR code at your table or enter your table number</p>
        </div>
    </div>
</body>
</html>