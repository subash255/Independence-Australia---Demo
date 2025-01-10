@extends('layouts.admin')

@section('content')
<div class="p-4 bg-white shadow-lg -mt-11 mx-4 z-20  rounded-lg">
    <!-- Order Header -->
    <div class="flex justify-between items-center mb-8">
        <h2 class="text-3xl font-semibold text-gray-800">Order #{{ $order->id }}</h2>
        <a href="{{ route('admin.order.index') }}" class="bg-gray-700 text-white px-8 py-3 rounded-lg hover:bg-gray-800 transition-colors">
            Back to Orders
        </a>
    </div>

    <!-- Order Information Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

        <!-- Billing Information Card -->
        <div class="bg-gray-50 p-6 rounded-lg shadow-md border border-gray-200">
            <h3 class="text-xl font-semibold text-gray-700 mb-5">Billing Information</h3>
            @if($billing)
                <div>
                    <p class="text-gray-600"><strong>Name:</strong> {{ $billing['first_name'] }} {{ $billing['last_name'] }}</p>
                    <p class="text-gray-600"><strong>Address:</strong> {{ $billing['address_1'] }}</p>
                    <p class="text-gray-600"><strong>City:</strong> {{ $billing['city'] }}</p>
                    <p class="text-gray-600"><strong>Country:</strong> {{ $billing['country'] }}</p>
                </div>
            @else
                <p class="text-red-500">No billing information available.</p>
            @endif
        </div>

        <!-- Shipping Information Card -->
        <div class="bg-gray-50 p-6 rounded-lg shadow-md border border-gray-200">
            <h3 class="text-xl font-semibold text-gray-700 mb-5">Shipping Information</h3>
            @if($shipping)
                <div>
                    <p class="text-gray-600"><strong>Name:</strong> {{ $shipping['first_name'] }} {{ $shipping['last_name'] }}</p>
                    <p class="text-gray-600"><strong>Address:</strong> {{ $shipping['address_1'] }}</p>
                    <p class="text-gray-600"><strong>City:</strong> {{ $shipping['city'] }}</p>
                    <p class="text-gray-600"><strong>Country:</strong> {{ $shipping['country'] }}</p>
                </div>
            @else
                <p class="text-red-500">No shipping information available.</p>
            @endif
        </div>

    </div>

    <!-- Order Items Section -->
    <div class="bg-white p-6 rounded-lg shadow-md mt-8">
        <h3 class="text-xl font-semibold text-gray-700 mb-5">Order Items</h3>
        @if($orderitems && count($orderitems) > 0)
            <div class="space-y-6">
                @foreach($orderitems as $item)
                    <div class="flex justify-between items-center p-4 border-b border-gray-200">
                        <div class="flex items-center space-x-6">
                            <!-- Display Product Image -->
                            <img src="{{ $item->image }}" alt="{{ $item->name }}" class="w-36 h-36 object-cover rounded-md">
                            <div>
                                <h4 class="font-semibold text-gray-800">{{ $item->name }}</h4>
                                <p class="text-gray-600 text-sm">SKU: {{ $item->sku }}</p>
                            </div>
                        </div>
                        <div>
                            <p class="text-gray-600"><strong>Quantity:</strong> {{ $item->quantity }}</p>
                            <p class="text-gray-600"><strong>Price:</strong> ${{ number_format($item->price, 2) }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-center text-gray-600">No items available for this order.</p>
        @endif
    </div>

    <!-- Order Status Section -->
    <div class="bg-white p-6 rounded-lg shadow-md mt-8">
        <h3 class="text-xl font-semibold text-gray-700 mb-5">Order Status</h3>
        <div>
            <p class="text-gray-600"><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
            <p class="text-gray-600"><strong>Total Price:</strong> ${{ number_format($order->total, 2) }}</p>
            <p class="text-gray-600"><strong>Order Date:</strong> {{ $order->created_at->format('d M Y, H:i') }}</p>
        </div>
    </div>
</div>
@endsection
