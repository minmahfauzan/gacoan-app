@extends('admin.layouts.app')

@section('content')
    <div class="container mx-auto px-4 sm:px-8">
        <div class="py-8">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-semibold">Table QR Codes</h1>
                <button onclick="window.print();"
                    class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50">
                    Print QR Codes
                </button>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mt-8">
                @foreach ($tables as $table)
                    <div class="bg-white rounded-lg shadow-lg p-6 text-center">
                        <h2 class="text-xl font-bold mb-4">Meja {{ $table->id }}</h2>
                        <div class="flex justify-center">
                            <img src="{{ $qrCodes[$table->id] }}" alt="QR Code for table {{ $table->id }}"
                                class="w-40 h-40" loading="lazy">
                        </div>
                        <p class="mt-4 text-sm text-gray-600">
                            Scan to login to table {{ $table->id }}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
