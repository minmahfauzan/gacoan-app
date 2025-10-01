<div class="space-y-4">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <h4 class="font-semibold text-gray-700 mb-2">Order Information</h4>
            <div class="space-y-2">
                <div class="flex">
                    <span class="w-32 text-gray-600">Order Number:</span>
                    <span class="font-medium">{{ $order->order_number }}</span>
                </div>
                <div class="flex">
                    <span class="w-32 text-gray-600">Table:</span>
                    <span class="font-medium">{{ $order->table->table_number }}</span>
                </div>
                <div class="flex">
                    <span class="w-32 text-gray-600">Nama Pemesan:</span>
                    <span class="font-medium">{{ $order->nama_pemesan }}</span>
                </div>
                @if($order->keterangan)
                <div class="flex">
                    <span class="w-32 text-gray-600">Keterangan:</span>
                    <span class="font-medium">{{ $order->keterangan }}</span>
                </div>
                @endif
                <div class="flex">
                    <span class="w-32 text-gray-600">Status:</span>
                    <span class="font-medium capitalize">{{ $order->status }}</span>
                </div>
                <div class="flex">
                    <span class="w-32 text-gray-600">Ordered At:</span>
                    <span>{{ $order->created_at->format('d M Y, H:i') }}</span>
                </div>
            </div>
        </div>
        
        <div>
            <h4 class="font-semibold text-gray-700 mb-2">Order Summary</h4>
            <div class="space-y-2">
                <div class="flex justify-between">
                    <span>Subtotal:</span>
                    <span>Rp{{ number_format($order->total_amount, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between">
                    <span>Tax:</span>
                    <span>Rp0</span>
                </div>
                <div class="flex justify-between font-bold border-t pt-2">
                    <span>Total:</span>
                    <span>Rp{{ number_format($order->total_amount, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>
    </div>
    
    <div>
        <h4 class="font-semibold text-gray-700 mb-2">Items Ordered</h4>
        <div class="bg-gray-50 rounded-lg p-4">
            <table class="w-full">
                <thead class="border-b">
                    <tr>
                        <th class="text-left py-2">Item</th>
                        <th class="text-right py-2">Qty</th>
                        <th class="text-right py-2">Price</th>
                        <th class="text-right py-2">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->orderItems as $item)
                    <tr>
                        <td class="py-2">{{ $item->product->name }}</td>
                        <td class="text-right py-2">{{ $item->quantity }}</td>
                        <td class="text-right py-2">Rp{{ number_format($item->price, 0, ',', '.') }}</td>
                        <td class="text-right py-2 font-medium">Rp{{ number_format($item->total, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>