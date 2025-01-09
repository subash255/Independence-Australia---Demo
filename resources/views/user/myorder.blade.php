@extends('layouts.master')
@section('content')


<div class="flex flex-col lg:flex-row">
        {{-- Sidebar/Nav Section --}}
        @include('user.nav')

    <!-- My orders -->
    <div class="container mx-auto mt-16 min-h-screen relative">
        <h1 class="text-3xl font-semibold text-gray-800">My Orders</h1>

        @if($orders->isEmpty())
        <p class="mt-4 text-gray-500">You have no orders.</p>
    @else
        <div class="overflow-x-auto mt-8">
            <table class="table-auto w-full border-collapse">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-6 py-3 text-left">Order ID</th>
                        <th class="px-6 py-3 text-left">Date</th>
                        <th class="px-6 py-3 text-left">Product Image</th>
                        <th class="px-6 py-3 text-left">Product</th>
                        <th class="px-6 py-3 text-left">Total</th>
                        <th class="px-6 py-3 text-left">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr class="border-b">
                            <td class="px-6 py-4">{{ $order->id }}</td>
                            <td class="px-6 py-4">{{ $order->created_at->format('d M, Y') }}</td>
                            <td class="border border-gray-300 px-4 py-2">
                                <img src="{{ $order->product->image }}" alt="" class="w-32">
                            </td>
                            <td class="border border-gray-300 px-4 py-2">
                                <span>{{ $order->product->name }}</span><br>
                        </td>
                            <td class="px-6 py-4">${{ number_format($order->total, 2) }}</td>
                            <td class="px-6 py-4">{{ ucfirst($order->status) }}</td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    </div>




@endsection
