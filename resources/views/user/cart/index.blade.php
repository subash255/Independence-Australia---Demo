@extends('layouts.master')
@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Your Cart</h1>

    @if ($cartItems->isEmpty())
        <p class="text-lg">Your cart is empty!</p>
    @else
        <div class="space-y-4">
            @foreach ($cartItems as $cartItem)
                <div class="flex justify-between items-center border-b pb-4">
                    <div class="flex items-center space-x-4">
                        <img src="{{ $cartItem->product->image }}" alt="{{ $cartItem->product->name }}" class="w-16 h-16 object-cover">
                        <div>
                            <h3 class="text-lg">{{ $cartItem->product->name }}</h3>
                            <p class="text-sm text-gray-600">${{ $cartItem->product->price }}</p>
                        </div>
                    </div>

                    <div class="flex items-center space-x-4">
                        <form action="{{ route('user.cart.update', $cartItem->id) }}" method="POST" class="flex items-center">
                            @csrf
                            <input type="number" name="quantity" value="{{ $cartItem->quantity }}" min="1" class="border rounded p-2 w-16 text-center">
                            <button type="submit" class="bg-green-500 text-white px-4 py-2 ml-2 rounded">Update</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-6 text-right">
            <a href="" class="bg-red-500 text-white px-6 py-2 rounded">Proceed to Checkout</a>
        </div>
    @endif
</div>
@endsection