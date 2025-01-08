@extends('layouts.master')
@section('content')

    {{-- Flash Message --}}
    @if(session('success'))
    <div id="flash-message" class="bg-green-500 text-white px-6 py-2 rounded-lg fixed top-4 right-4 shadow-lg z-50">
        {{ session('success') }}
    </div>
    @endif

    <script>
        if (document.getElementById('flash-message')) {
            setTimeout(() => {
                const msg = document.getElementById('flash-message');
                msg.style.opacity = 0;
                msg.style.transition = "opacity 0.5s ease-out";
                setTimeout(() => msg.remove(), 500);
            }, 3000);
        }
    </script>

    <div class="flex">
        <!-- Sidebar / Navigation Section -->
        <nav class="w-[21%] p-6 font-semibold mt-10">
            <a href="{{ route('user.welcome') }}" 
               class="flex items-center py-4 border-b border-gray-300 transition-colors duration-200
               hover:text-blue-500 focus:bg-gray-300 focus:text-blue-500 
               {{ request()->routeIs('user.welcome') ? 'bg-gray-300 text-blue-500 font-bold' : '' }}">
                <span class="ml-4">Account Dashboard</span>
            </a>
            <a href="{{ route('user.myorder') }}" 
               class="flex items-center py-4 border-b border-gray-300 transition-colors duration-200
               hover:text-blue-500 focus:bg-gray-300 focus:text-blue-500 
               {{ request()->routeIs('user.myorder') ? 'bg-gray-300 text-blue-500 font-bold' : '' }}">
                <span class="ml-4">Web Orders</span>
            </a>
            <a href="{{ route('user.contact.index') }}" 
               class="flex items-center py-4 border-b border-gray-300 transition-colors duration-200
               hover:text-blue-500 focus:bg-gray-300 focus:text-blue-500 
               {{ request()->routeIs('user.contact.index') ? 'bg-gray-300 text-blue-500 font-bold' : '' }}">
                <span class="ml-4">My Information</span>
            </a>
            <a href="#" 
               class="flex items-center py-4 border-b border-gray-300 transition-colors duration-200
               hover:text-blue-500 focus:bg-gray-300 focus:text-blue-500 
               {{ request()->routeIs('user.company.profile') ? 'bg-gray-300 text-blue-500 font-bold' : '' }}">
                <span class="ml-4">Company Profile</span>
            </a>
            <!-- Conditionally show User Management link for vendor roles -->
            @if(Auth::user()->role == 'vendor')
            <a href="{{ route('user.manageuser.index') }}" 
               class="flex items-center py-4 border-b border-gray-300 transition-colors duration-200
               hover:text-blue-500 focus:bg-gray-300 focus:text-blue-500 
               {{ request()->routeIs('user.manageuser.index') ? 'bg-gray-300 text-blue-500 font-bold' : '' }}">
                <span class="ml-4">User Management</span>
            </a>
            @endif
        </nav>
        
        <!-- Main Content Container -->
        <div class="w-full bg-white rounded-lg shadow-lg p-6">
            <!-- Warning Message -->
            <div class="bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4 mb-6">
                <p class="text-sm">
                    All billing address changes are subject to validation and approval. Any orders placed after modifying the billing address will be held until approval is granted.
                </p>
            </div>

            <!-- Address Section -->
            <div>
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Default Addresses</h2>
                <div class="flex justify-between gap-6">
                    <!-- Default Billing Address -->
                    <div class="w-1/2">
                        <h3 class="font-semibold text-gray-800 mb-2">Default Billing Address</h3>
                        @if($billing->count() > 0)
                        <p class="text-gray-700">{{ $billing->first()->firstname }} {{ $billing->first()->lastname }}</p>
                        <p class="text-gray-700">{{ $billing->first()->address }}</p>
                        <p class="text-gray-700">{{ $billing->first()->state }}, {{ $billing->first()->country }}, {{ $billing->first()->zip }}</p>
                        <p class="text-gray-700">T: {{ $billing->first()->contact_info }}</p>
                        @else
                        <p class="text-gray-600">You have no default billing address in your address book.</p>
                        @endif
                    </div>

                    <!-- Default Shipping Address -->
                    <div class="w-1/2">
                        <h3 class="font-semibold text-gray-800 mb-2">Default Shipping Address</h3>
                        @if($shipping->count() > 0)
                        <p class="text-gray-700">{{ $shipping->first()->firstname }} {{ $shipping->first()->lastname }}</p>
                        <p class="text-gray-700">{{ $shipping->first()->address }}</p>
                        <p class="text-gray-700">GLENDALOUGH, Western Australia, 6016</p>
                        <p class="text-gray-700">T: {{ $shipping->first()->shipping_info }}</p>
                        @else
                        <p class="text-gray-600">You have no default shipping address in your address book.</p>
                        @endif
                        <a href="#" class="text-blue-600 hover:underline text-sm font-medium">Change Shipping Address</a>
                    </div>
                </div>
            </div>

            <!-- Additional Address Entries -->
            <div class="mt-8">
              <h2 class="text-lg font-semibold text-gray-800 mb-4">Additional Address Entries</h2>
              <p class="text-gray-600">You currently have no other address entries in your address book.</p>
              
              <div class="pt-6">
                  <a href="{{ route('user.contact.address') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Add New Address</a>
              </div>
          </div>
          
        </div>
    </div>

@endsection
