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

<div class="flex">
    {{-- Sidebar/Nav Section --}}
    @include('user.nav')

    <!-- Container -->
    <div class="w-[79%] mx-auto p-6 mt-4">

        <form action="{{ route('user.contact.store') }}" method="POST">
            @csrf
            <input type="hidden" name="user_id" value="{{ $userId }}">

            <!-- Flex Container -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                <!-- Contact Information -->
                <div>
                    <h2 class="text-2xl font-semibold mb-2 text-blue-500">Contact Information</h2>
                    <hr class="border-b border-gray-300 mt-2 mb-4 w-[80%]">
                    <!-- First Name -->
                    <div class="mb-4">
                        <label for="firstname" class="block text-sm font-medium text-gray-700">First Name</label>
                        <input type="text" id="firstname" name="firstname" value="{{ old('firstname')?? auth()->user()->name }}"
                               class="mt-1 py-3 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                               required>
                    </div>

                    <!-- Last Name -->
                    <div class="mb-4">
                        <label for="lastname" class="block text-sm font-medium text-gray-700">Last Name</label>
                        <input type="text" id="lastname" name="lastname" value="{{ old('lastname') ?? auth()->user()->last_name }}"
                               class="mt-1 py-3 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                               required>
                    </div>

                    <!-- Phone Number -->
                    <div class="mb-4">
                        <label for="contact_info" class="block text-sm font-medium text-gray-700">Phone Number</label>
                        <input type="text" id="contact_info" name="contact_info" placeholder="XX XXXX XXXX"
                               value="{{ old('contact_info') ?? auth()->user()->phone_number }}"
                               class="mt-1 py-3 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                               required>
                    </div>
                </div>

                <!-- Address Information -->
                <div>
                <h2 class="text-2xl font-semibold mb-2 text-blue-500">Address</h2>
<hr class="border-b border-gray-300 mt-2 mb-4 w-[80%]">

<div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
    <!-- Address Field -->
    <div class="mb-4">
        <label for="address" class="block text-sm font-medium text-gray-700">Please enter your address</label>
        <input type="text" id="address" name="address_1" placeholder="e.g. 123 Long Street, Melbourne VIC, 3000"
               value="{{ old('address') }}"
               class="mt-1 py-3 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
               required>
    </div>

    <!-- City Field -->
    <div class="mb-4">
        <label for="city" class="block text-sm font-medium text-gray-700">City</label>
        <input type="text" id="city" name="city" placeholder="e.g. Melbourne"
               value="{{ old('city') }}"
               class="mt-1 py-3 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
               required>
    </div>

    <!-- Zip Code Field -->
    <div class="mb-4">
        <label for="zip" class="block text-sm font-medium text-gray-700">Zip Code</label>
        <input type="text" id="zip" name="zip" placeholder="e.g. 3000"
               value="{{ old('zip') }}"
               class="mt-1 py-3 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
               required>
    </div>

    <!-- Country Field -->
    <div class="mb-4">
        <label for="country" class="block text-sm font-medium text-gray-700">Country</label>
        <input type="text" id="country" name="country" placeholder="e.g. Australia"
               value="{{ old('country') }}"
               class="mt-1 py-3 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
               required>
    </div>

    <!-- State Field -->
    <div class="mb-4">
        <label for="state" class="block text-sm font-medium text-gray-700">State</label>
        <input type="text" id="state" name="state" placeholder="e.g. Victoria"
               value="{{ old('state') }}"
               class="mt-1 py-3 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
               required>
    </div>

    <!-- Phone Number Field -->
    <div class="mb-4">
        <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
        <input type="tel" id="phone" name="phone" placeholder="e.g. +61 412 345 678"
               value="{{ old('phone') }}"
               class="mt-1 py-3 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
               required>
    </div>
</div>


                    <!-- Default Billing and Shipping -->
                    <div class="flex items-center mb-2">
                        <input type="checkbox" id="is_billing" name="is_billing" value="yes"
                               class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <label for="is_billing" class="ml-2 text-sm text-gray-600">Use as my default billing address</label>
                    </div>

                    <div class="flex items-center mb-4">
                        <input type="checkbox" id="is_shipping" name="is_shipping" value="yes"
                               class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <label for="is_shipping" class="ml-2 text-sm text-gray-600">Use as my default shipping address</label>
                    </div>
                    <div class="text-center mr-[6rem] mt-[4rem]">
                        <button type="submit"
                        class="py-[10px] px-[20px] bg-blue-500 text-white font-bold rounded-[24px] border-2 border-blue-500 hover:bg-[#ffffff] hover:text-blue-500 transition">
                        Save Address
                        </button>
                    </div>
                </div>

            </div>

        </form>
    </div>
</div>

@endsection
