@extends('admin.layouts.app')

@section('title', 'Products Management')

@section('content')

    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Products Management</h1>
            <p class="text-gray-600">Manage all products in your restaurant</p>
        </div>
        <a href="{{ route('admin.products.create') }}"
            class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg transition">
            + Add New Product
        </a>
    </div>

    <!-- Products Table -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($products as $product)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $product->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $product->category->name ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                Rp{{ number_format($product->price, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" value="" class="sr-only peer toggle-status-checkbox"
                                        data-product-id="{{ $product->id }}" {{ $product->is_active ? 'checked' : '' }}>
                                    <div
                                        class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-red-300 dark:peer-focus:ring-red-800 dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-red-600">
                                    </div>
                                </label>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('admin.products.edit', $product->id) }}"
                                    class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
                                    class="inline-block ml-4"
                                    onsubmit="return confirm('Are you sure you want to delete this product?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                <p>No products found. <a href="{{ route('admin.products.create') }}"
                                        class="text-red-600 hover:underline">Add one now</a>.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if ($products->hasPages())
            <div class="bg-white px-6 py-3 border-t border-gray-200">
                {{ $products->links() }}
            </div>
        @endif
    </div>
    @section('scripts')
        <script>
            $(document).ready(function() {
                $('.toggle-status-checkbox').change(function() {
                    var checkbox = $(this);
                    var productId = checkbox.data('product-id');
                    var url = "{{ route('admin.products.toggle-status', ':id') }}".replace(':id', productId);

                    $.ajax({
                        url: url,
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (!response.success) {
                                alert('Failed to update status.');
                                checkbox.prop('checked', !checkbox.prop('checked'));
                            }
                        },
                        error: function() {
                            alert('An error occurred. Please try again.');
                            checkbox.prop('checked', !checkbox.prop('checked'));
                        }
                    });
                });
            });
        </script>
    @endsection
@endsection
