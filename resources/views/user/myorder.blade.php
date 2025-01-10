@extends('layouts.master')

@section('content')
<div class="flex flex-col lg:flex-row">
    {{-- Sidebar/Nav Section --}}
    @include('user.nav')

    <!-- My orders -->
    <div class="container mx-auto mt-16 min-h-screen relative">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6">My Orders</h1>

        @if($orders->isEmpty())
        <p class="mt-4 text-gray-500">You have no orders.</p>
        @else
        <div class="overflow-x-auto mt-8 bg-white shadow-lg rounded-lg">
            <table class="table-auto w-full border-collapse">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Order ID</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Date</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Products</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Total</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr class="border-b hover:bg-gray-50">
                        <!-- Display Order ID -->
                        <td class="px-6 py-4 text-sm text-gray-800">{{ $order->id }}</td>

                        <!-- Display Order Date -->
                        <td class="px-6 py-4 text-sm text-gray-800">{{ $order->created_at->format('d M, Y') }}</td>

                        <!-- Loop through order items (handling multiple products) -->
                        <td class="px-6 py-4">
                            <div class="flex space-x-4 overflow-x-auto">
                                @foreach($order->orderitems as $orderItem)
                                <div class="flex flex-col items-center">
                                    <!-- Display Product Image -->
                                    <img src="{{ $orderItem->image }}" alt="Product Image" class="w-16 h-16 object-cover rounded-md mb-2">
                                    <!-- Display Product Name -->
                                    <span class="text-xs text-gray-600">{{ $orderItem->name }}</span>
                                </div>
                                @endforeach
                            </div>
                        </td>

                        <!-- Display Order Total -->
                        <td class="px-6 py-4 text-sm text-gray-800">${{ number_format($order->total, 2) }}</td>

                        <!-- Display Order Status -->
                        <td class="px-6 py-4 text-sm font-semibold text-gray-700 capitalize">
                            {{ ucfirst($order->status) }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
</div>
@endsection
            