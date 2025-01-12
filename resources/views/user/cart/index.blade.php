@extends('layouts.master')
@section('content')
{{-- Flash Message --}}
@if(session('success'))
<div id="flash-message" class="bg-green-500 text-white px-6 py-2 rounded-lg fixed top-4 right-4 shadow-lg z-50">
    {{ session('success') }}
</div>
@endif

<script>
    if (document.getElementById('flash-message')) setTimeout(() => {
        const msg = document.getElementById('flash-message');
        msg.style.opacity = 0;
        msg.style.transition = "opacity 0.5s ease-out";
        setTimeout(() => msg.remove(), 500);
    }, 3000);
</script>

@if($cartItems->isEmpty())
<div class="flex items-center justify-center mt-10">
    <i class="ri-shopping-cart-line text-6xl text-gray-400 mr-4"></i>
    <p class="text-lg text-gray-600">Your cart is empty!</p>
</div>
@else
<div class="container mx-auto mt-16 min-h-screen relative">

    <div class="sm:flex shadow-lg rounded-lg my-12 overflow-hidden">
        <!-- Cart Items Section -->
        <div class="w-full sm:w-3/4 bg-white px-8 py-10">
            <div class="flex justify-between border-b pb-8 mb-6">
                <h1 class="font-semibold text-2xl text-gray-800">Shopping Cart</h1>
                <h2 class="font-semibold text-2xl text-gray-600">{{ count($cartItems) }} Items</h2>
            </div>


            <!-- Cart Item Loop -->
            <div class="space-y-6">
                @foreach ($cartItems as $cartItem)
                <div class="flex border-b py-6">
                    <!-- Product Image -->
                    <div class="w-1/4">
                        <img src="{{ $cartItem->product->image }}" alt="{{ $cartItem->product->name }}"
                            class="w-full h-24 object-contain" />
                    </div>

                    <!-- Product Details -->
                    <div class="w-3/4 pl-6 flex flex-col justify-between">
                        <p class="text-sm text-gray-600">{{ $cartItem->product->sku }}</p>
                        <div class="flex justify-between items-center mt-2">
                            <p class="text-lg font-semibold text-gray-800">{{ $cartItem->product->name }}</p>
                            <form action="{{route('user.cart.remove', $cartItem->id)}} " method="POST"
                                class="text-xs text-red-500 hover:text-red-700 cursor-pointer">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="underline">Remove</button>
                            </form>
                        </div>

                        <!-- Quantity Update Form -->
                        <div class="flex justify-between items-center mt-4">
                            <form action="{{ route('user.cart.update', $cartItem->id) }}" method="POST"
                                class="flex items-center">
                                @csrf
                                @method('PATCH')
                                <input type="number" name="quantity" min="1"
                                    value="{{ $cartItem->quantity }}"
                                    class="w-16 p-2 text-center border border-gray-300 rounded-md" />
                                <button type="submit"
                                    class="ml-4 bg-blue-500 hover:bg-blue-600 text-white text-sm py-2 px-4 rounded-md">Update</button>
                            </form>
                            <p class="text-lg font-semibold text-gray-800">
                                ${{ number_format($cartItem->product->price * $cartItem->quantity, 2) }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Order Summary Section -->
        <div id="summary" class="w-full sm:w-1/4 md:w-1/2 bg-gray-50 px-8 py-10">
            <h1 class="font-semibold text-2xl text-gray-800 border-b pb-6">Order Summary</h1>

            <!-- Item Count and Total -->
            <div class="flex justify-between mt-6">
                <span class="text-sm font-semibold text-gray-600">Items ({{ count($cartItems) }})</span>
                <span
                    class="text-sm font-semibold text-gray-800">${{ number_format($cartItems->sum(fn($item) => $item->product->price * $item->quantity), 2) }}</span>
            </div>

            <!-- Shipping Option -->
            <div class="mt-6">
                <label class="font-medium inline-block mb-3 text-sm text-gray-600">Shipping</label>
                <select
                    class="block p-3 text-sm text-gray-600 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option>Standard Shipping - $10.00</option>
                </select>
            </div>

            <!-- Promo Code Input -->
            <div class="mt-6">
                <label for="promo" class="font-semibold inline-block mb-3 text-sm text-gray-600">Promo Code</label>
                <input type="text" id="promo" placeholder="Enter your code"
                    class="p-3 text-sm w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" />
            </div>

            <button
                class="bg-red-500 hover:bg-red-600 px-5 py-2 text-sm text-white font-semibold uppercase mt-4 w-full rounded-md">Apply</button>

            <!-- Total Cost -->
            <div class="border-t mt-8 pt-6">
                <div class="flex justify-between text-sm font-semibold text-gray-600 uppercase mb-4">
                    <span>Total cost</span>
                    <span class="text-lg font-semibold text-gray-800">
                        ${{ number_format($cartItems->sum(fn($item) => $item->product->price * $item->quantity) + 10, 2) }}
                    </span>
                </div>

                <!-- Proceed to Checkout Button -->
                <form action="{{ route('checkout.process') }}" method="POST">
                    @csrf
                    <input type="hidden" name="total" value="{{ $cartItems->sum(fn($item) => $item->product->price * $item->quantity) + 10 }}">

                    <button type="submit"
                        class="bg-indigo-500 font-semibold hover:bg-indigo-600 py-3 px-5 text-sm text-white uppercase w-full text-center rounded-md mt-8">
                        Proceed to Checkout
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endif

    <!-- Continue Shopping Link at Bottom Left Corner -->
    <div class="absolute  left-0 mb-6 ml-6 lg:block hidden">
        <a href="{{ route('product.index') }}" class="flex font-semibold text-indigo-600 text-sm hover:underline">
            <i class="ri-arrow-left-s-line text-indigo-600 mr-2"></i> Continue Shopping
        </a>
    </div>

</div>

@endsection