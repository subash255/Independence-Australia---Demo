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
                            <form action="{{ route('user.cart.remove', $cartItem->id) }}" method="POST"
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
                                <input type="number" name="quantity" min="1" value="{{ $cartItem->quantity }}"
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

            <!-- Stripe Payment Checkbox -->
            <input type="checkbox" id="stripe" name="payment" /> <label for="stripe">Pay with Stripe</label>

            <!-- Stripe Payment Form (hidden by default) -->
            <div id="stripe-payment-form" style="display:none;">
                <form id="payment-form">
                    <div id="card-element">
                        <!-- A Stripe Element will be inserted here. -->
                    </div>
                    <div id="card-errors" role="alert"></div>
                    <button id="submit" class="w-full mt-6 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 px-5 rounded-md">
                        Pay Now
                    </button>
                </form>
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
<script src="https://js.stripe.com/v3/"></script>
<script>
    document.getElementById('stripe').addEventListener('change', function() {
        var paymentForm = document.getElementById('stripe-payment-form');
        if (this.checked) {
            paymentForm.style.display = 'block';
            initStripe();
        } else {
            paymentForm.style.display = 'none';
        }
    });

    function initStripe() {
        var stripe = Stripe('{{ env('STRIPE_KEY') }}');
        var elements = stripe.elements();
        var card = elements.create('card');
        card.mount('#card-element');

        var form = document.getElementById('payment-form');
        form.addEventListener('submit', async function(event) {
            event.preventDefault();

            const { clientSecret } = await fetch('/create-payment-intent', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    total: '{{ $cartItems->sum(fn($item) => $item->product->price * $item->quantity) + 10 }}',
                }),
            }).then((res) => res.json());

            const { error, paymentIntent } = await stripe.confirmCardPayment(clientSecret, {
                payment_method: {
                    card: card,
                }
            });

            if (error) {
                document.getElementById('card-errors').textContent = error.message;
            } else if (paymentIntent.status === 'succeeded') {
                alert('Payment Successful!');
                window.location.href = '/thank-you'; // Redirect to thank you page
            }
        });
    }
</script>
@endif
@endsection
