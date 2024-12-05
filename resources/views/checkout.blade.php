@extends('layouts.master')

@section('content')

<div class="container mx-auto p-8 bg-white rounded-lg shadow-xl flex flex-col lg:flex-row gap-8 mt-14">

    <!-- Left Side: Order Details (Products) -->
    <div class="w-full lg:w-2/3 bg-gray-50 p-8 rounded-lg shadow-md">
        <h2 class="text-3xl font-bold text-[#00718f] mb-6">Order Details</h2>

        <!-- User Info -->
        <div class="mb-6">
            <p class="text-lg font-semibold text-gray-600">Shipping to: </p>
            <p class="text-lg text-gray-600">Email: </p>
            <p class="text-lg text-gray-600">Phone: </p>
        </div>

        <div class="mt-6 border-t pt-4">
            <div class="flex justify-between">
                <p class="text-lg text-gray-800 font-semibold">Subtotal</p>
                <p class="text-lg text-gray-800">Rs. XXX</p>
            </div>

            <!-- Apply Discount / Coupon -->
            <div class="mt-4">
                <input type="text" placeholder="Enter discount code" class="w-full mb-4 p-3 border rounded-md text-lg" id="coupon-code">
                <button id="apply-coupon" class="inline-block bg-white border-2 border-[#00718f] text-[#00718f] font-lg font-bold w-full py-3 rounded-[24px] hover:bg-[#00718f] hover:text-white transition-colors">Apply</button>
            </div>

            <div class="flex justify-between mt-6 text-lg font-semibold text-gray-800">
                <p>Total</p>
                <p>Rs. XXX</p>
            </div>
        </div>
    </div>

<!-- Right Side: Payment Method Selection -->
<div class="w-full lg:w-1/3 bg-gray-50 p-6 rounded-lg shadow-md">
    <h1 class="text-3xl font-bold mb-6 text-center text-[#00718f]">Payment Methods</h1>

    <!-- Payment Method Selection Form -->
    <form action="#" method="POST">

        <div class="flex flex-col space-y-4">

            <!-- Visa Card Payment Option -->
            <label class="border rounded-lg p-4 flex items-center justify-start cursor-pointer transition-transform transform hover:scale-105 shadow-md hover:shadow-lg duration-300">
                <input type="radio" name="payment_method" value="visa" class="mr-4" required>
                <span class="flex items-center text-gray-800">
                    <i class="ri-visa-fill mr-4 text-[#00718f]"></i>
                    <span class="text-lg font-medium">Visa</span>
                </span>
            </label>

            <!-- MasterCard Payment Option -->
            <label class="border rounded-lg p-4 flex items-center justify-start cursor-pointer transition-transform transform hover:scale-105 shadow-md hover:shadow-lg duration-300">
                <input type="radio" name="payment_method" value="mastercard" class="mr-4" required>
                <span class="flex items-center text-gray-800">
                    <i class="ri-mastercard-fill mr-4 text-[#00718f]"></i>
                    <span class="text-lg font-medium">MasterCard</span>
                </span>
            </label>

            <!-- PayPal Payment Option -->
            <label class="border rounded-lg p-4 flex items-center justify-start cursor-pointer transition-transform transform hover:scale-105 shadow-md hover:shadow-lg duration-300">
                <input type="radio" name="payment_method" value="paypal" class="mr-4" required>
                <span class="flex items-center text-gray-800">
                    <i class="ri-paypal-fill mr-4 text-[#00718f]"></i>
                    <span class="text-lg font-medium">PayPal</span>
                </span>
            </label>

        </div>

        <div class="mt-6 text-center">
            <button type="submit" class="py-[10px] px-[20px] bg-[#00718f] text-white font-bold rounded-[24px] border-2 border-[#00718f] hover:bg-[#ffffff] hover:text-[#00718f] transition">
                Proceed to Payment
            </button>
        </div>
    </form>
</div>


</div>

@endsection
