@extends('layouts.master')
@section('content')

    <div class="container mx-auto px-6 py-8">
        <h1 class="text-3xl font-semibold text-center mb-6">Checkout Form</h1>

        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-4 mb-6 rounded-md">{{ session('success') }}</div>
        @elseif(session('error'))
            <div class="bg-red-100 text-red-700 p-4 mb-6 rounded-md">{{ session('error') }}</div>
        @endif

        <!-- Checkout Form -->
        <form action="{{ route('checkout.process') }}" method="POST" class="bg-white p-6 rounded-lg shadow-lg">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Billing Information -->
                <div>
                    <h3 class="text-2xl font-semibold mb-4">Billing Information</h3>
                    <div class="space-y-4">

                        <div class="flex gap-6">
                            <div class="w-1/2">
                                <label for="billing_first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                                <input type="text" id="billing_first_name" name="billing[first_name]"
                                    value="{{ old('billing.first_name') }}" class="mt-1 w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="John" required>
                            </div>

                            <div class="w-1/2">
                                <label for="billing_last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                                <input type="text" id="billing_last_name" name="billing[last_name]"
                                    value="{{ old('billing.last_name') }}" class="mt-1 w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Doe" required>
                            </div>
                        </div>

                        <div>
                            <label for="billing_address_1" class="block text-sm font-medium text-gray-700">Address 1</label>
                            <input type="text" id="billing_address_1" name="billing[address_1]"
                                value="{{ old('billing.address_1') }}" class="mt-1 w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="123 Main St" required>
                        </div>

                        <div class="flex gap-6">
                            <div class="w-1/2">
                                <label for="billing_city" class="block text-sm font-medium text-gray-700">City</label>
                                <input type="text" id="billing_city" name="billing[city]"
                                    value="{{ old('billing.city') }}" class="mt-1 w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="New York" required>
                            </div>

                            <div class="w-1/2">
                                <label for="billing_state" class="block text-sm font-medium text-gray-700">State</label>
                                <input type="text" id="billing_state" name="billing[state]"
                                    value="{{ old('billing.state') }}" class="mt-1 w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="NY" required>
                            </div>
                        </div>

                        <div class="flex gap-6">
                            <div class="w-1/2">
                                <label for="billing_postcode" class="block text-sm font-medium text-gray-700">Postcode</label>
                                <input type="text" id="billing_postcode" name="billing[postcode]"
                                    value="{{ old('billing.postcode') }}" class="mt-1 w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="10001" required>
                            </div>

                            <div class="w-1/2">
                                <label for="billing_country" class="block text-sm font-medium text-gray-700">Country</label>
                                <input type="text" id="billing_country" name="billing[country]"
                                    value="{{ old('billing.country') }}" class="mt-1 w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="USA" required>
                            </div>
                        </div>

                        <div>
                            <label for="billing_email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" id="billing_email" name="billing[email]"
                                value="{{ old('billing.email') }}" class="mt-1 w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="example@example.com" required>
                        </div>

                        <div>
                            <label for="billing_phone" class="block text-sm font-medium text-gray-700">Phone</label>
                            <input type="text" id="billing_phone" name="billing[phone]"
                                value="{{ old('billing.phone') }}" class="mt-1 w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="(123) 456-7890" required>
                        </div>
                    </div>
                </div>

                <!-- Shipping Information -->
                <div>
                    <h3 class="text-2xl font-semibold mb-4">Shipping Information</h3>
                    <div class="space-y-4">

                        <div class="flex gap-6">
                            <div class="w-1/2">
                                <label for="shipping_first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                                <input type="text" id="shipping_first_name" name="shipping[first_name]"
                                    value="{{ old('shipping.first_name') }}" class="mt-1 w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="John" required>
                            </div>

                            <div class="w-1/2">
                                <label for="shipping_last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                                <input type="text" id="shipping_last_name" name="shipping[last_name]"
                                    value="{{ old('shipping.last_name') }}" class="mt-1 w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Doe" required>
                            </div>
                        </div>

                        <div>
                            <label for="shipping_address_1" class="block text-sm font-medium text-gray-700">Address 1</label>
                            <input type="text" id="shipping_address_1" name="shipping[address_1]"
                                value="{{ old('shipping.address_1') }}" class="mt-1 w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="123 Main St" required>
                        </div>

                        <div class="flex gap-6">
                            <div class="w-1/2">
                                <label for="shipping_city" class="block text-sm font-medium text-gray-700">City</label>
                                <input type="text" id="shipping_city" name="shipping[city]"
                                    value="{{ old('shipping.city') }}" class="mt-1 w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="New York" required>
                            </div>

                            <div class="w-1/2">
                                <label for="shipping_state" class="block text-sm font-medium text-gray-700">State</label>
                                <input type="text" id="shipping_state" name="shipping[state]"
                                    value="{{ old('shipping.state') }}" class="mt-1 w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="NY" required>
                            </div>
                        </div>

                        <div class="flex gap-6">
                            <div class="w-1/2">
                                <label for="shipping_postcode" class="block text-sm font-medium text-gray-700">Postcode</label>
                                <input type="text" id="shipping_postcode" name="shipping[postcode]"
                                    value="{{ old('shipping.postcode') }}" class="mt-1 w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="10001" required>
                            </div>

                            <div class="w-1/2">
                                <label for="shipping_country" class="block text-sm font-medium text-gray-700">Country</label>
                                <input type="text" id="shipping_country" name="shipping[country]"
                                    value="{{ old('shipping.country') }}" class="mt-1 w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="USA" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="mt-8 justify-center flex">
                <button type="submit"
                class="text-[#00718f] font-medium bg-white border-2 border-[#00718f] rounded-lg py-2 px-24 hover:bg-[#00718f] hover:text-white transition duration-300">
               Place Order</button>
            </div>
        </form>
    </div>


@endsection