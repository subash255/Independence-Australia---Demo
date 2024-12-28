@extends('layouts.master')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-4xl font-bold text-gray-900 mb-8">Your Shopping Cart</h1>

    @if ($cartItems->isEmpty())
        <div class="flex justify-center items-center text-center">
            <p class="text-xl text-gray-500">Your cart is currently empty. Start shopping now!</p>
        </div>
    @else
        <div class="space-y-8">
            @foreach ($cartItems as $cartItem)
                <div class="flex justify-between items-center bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <div class="flex items-center space-x-6">
                        <img src="{{ $cartItem->product->image }}" alt="{{ $cartItem->product->name }}" class="w-24 h-24 object-cover rounded-md shadow-md transition-transform transform hover:scale-105">
                        
                        <div>
                            <h3 class="text-2xl font-semibold text-gray-800">{{ $cartItem->product->name }}</h3>
                            <p class="text-sm text-gray-600 mt-2">${{ number_format($cartItem->product->price, 2) }}</p>
                        </div>
                    </div>

                    <div class="flex items-center space-x-6">
                        <form action="{{ route('user.cart.update', $cartItem->id) }}" method="POST" class="flex items-center space-x-2">
                            @csrf
                            <input type="number" name="quantity" value="{{ $cartItem->quantity }}" min="1" class="border-2 border-gray-300 rounded-lg p-3 w-24 text-center focus:outline-none focus:ring-2 focus:ring-green-500 transition-all">
                            <button type="submit" class="bg-green-600 text-white text-sm px-6 py-3 rounded-lg transition-transform transform hover:scale-105 hover:bg-green-700 duration-200">Update</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Order Summary Section -->
        <div class="mt-12 bg-gray-50 p-6 rounded-lg shadow-md">
            <div class="flex justify-between items-center mb-3">
                <span class="text-gray-600">Subtotal</span>
                <span class="font-semibold text-lg">${{ number_format($cartItems->sum(fn($item) => $item->product->price * $item->quantity), 2) }}</span>
            </div>
            <div class="flex justify-between items-center mb-3">
                <span class="text-gray-600">Shipping</span>
                <span class="font-semibold text-lg">$5.00</span>
            </div>
            <div class="flex justify-between items-center mb-3">
                <span class="text-gray-600">Tax</span>
                <span class="font-semibold text-lg">$3.00</span>
            </div>
            <div class="flex justify-between items-center mb-5 font-semibold text-lg">
                <span>Total</span>
                <span>${{ number_format($cartItems->sum(fn($item) => $item->product->price * $item->quantity) + 5 + 3, 2) }}</span>
            </div>
            <a href="{{ route('user.cart.show') }}" class="w-full bg-green-600 text-white font-semibold py-2 rounded-md hover:bg-green-700 transition duration-200 text-center">
                Proceed to Checkout
            </a>
        </div>
    @endif
</div>
@endsection
