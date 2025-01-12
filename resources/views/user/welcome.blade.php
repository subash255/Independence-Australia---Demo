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

<div class="p-16 items-center justify-between bg-cover bg-center" style="background-image: url('/images/dr.jpg');">
    <div class="my-8 ml-8 max-w-7xl mx-auto">
        <!-- Breadcrumbs -->
        <div class="text-sm text-gray-500">
            <a href="/" class="hover:text-blue-500">Home</a> |
            <a href="{{ route('user.welcome') }}"><span>Dashboard</span></a>
        </div>

        <!-- Welcome Heading -->
        <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold text-blue-500 mt-2">Welcome {{ Auth::user()->name }}!</h1>

        <hr class="border-b border-gray-300 mt-2 mb-2 w-3/4 sm:w-2/4 md:w-1/4">

        <p class="text-gray-600 mt-1 text-base sm:text-lg md:text-xl">
            You are currently managing <br>
            <span class="font-semibold text-blue-500">{{ Auth::user()->name }} {{ Auth::user()->last_name }}
                @if (Auth::user()->role == 'vendor')
                B2B
                Customer
            </span>
            @endif
        </p>

        <!-- Check if the current user is a vendor, then show the Switch Account Button -->
        @if (Auth::user()->role == 'vendor')
        <!-- Adjust this condition based on how you define a vendor -->
        <button class="mt-4 flex items-center bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-500"
            onclick="toggleModal()">
            <i class="ri-refresh-line pr-2"></i>
            Switch Account
        </button>

        <!-- Modal -->
        <div id="user-modal"
            class="hidden fixed inset-0 z-50 bg-black bg-opacity-50 flex justify-center items-center p-4">
            <div class="bg-white p-6 rounded-lg w-full max-w-md relative shadow-xl">

                <!-- Modal Header -->
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-2xl font-semibold text-gray-900">Select User to Switch</h2>
                    <button onclick="toggleModal()" class="text-gray-500 hover:text-gray-700 focus:outline-none">
                        <i class="ri-close-line text-[5vh]"></i>
                    </button>
                </div>

                <!-- Search Bar -->
                <input type="text" id="search-user" placeholder="Search users..."
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 mb-4" />

                <!-- User List -->
                <ul id="user-list" class="py-2 space-y-2 max-h-60 overflow-y-auto">
                    @foreach ($users as $user)
                    <li
                        class="user-item px-4 py-2 hover:bg-gray-100 cursor-pointer transition ease-in-out duration-150  border-b border-gray-300">
                        <a href="{{ route('impersonate', $user->id) }}" class="block text-gray-800">
                            <span class="font-medium">{{ $user->name }} {{ $user->last_name }}</span>
                        </a>
                    </li>
                    @endforeach
                </ul>


            </div>
        </div>
        @endif

        @if (session('impersonating'))
        <div class="mt-4 flex items-center space-x-4"> <!-- Use flex to align buttons on the same row -->

            <!-- Show a button to stop impersonating -->
            <form action="{{ route('stop.impersonation') }}" method="POST" class="inline-block">
                @csrf
                <button type="submit"
                    class="flex items-center bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-200">
                    <i class="ri-arrow-left-line pr-2"></i>
                    Switch Back
                </button>
            </form>

            <!-- Start Shopping Button -->
            <a href="/"
                class="inline-flex items-center justify-center bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-200">
                Start Shopping
            </a>
        </div>
        @endif

    </div>
</div>

<div class="flex flex-col lg:flex-row">
    {{-- Sidebar/Nav Section --}}
    @include('user.nav')

    <!-- Main Content Section -->
    <div class="lg:w-[79%] w-full p-6 mt-4">
        <div id="account-info">
            <h1 class="text-3xl font-bold text-blue-500 mt-2">Account Information</h1>
            <hr class="border-b border-gray-300 mt-2 mb-2 w-[80%]">
            <h2 class="text-xl font-bold text-gray-800 mt-2 py-4">Contact Information</h2>
            <div class="flex flex-col space-y-2">
                <span> <b>Company Name:</b> BITS Pvt. Ltd.</span>
                <span> <b>Name:</b> {{ Auth::user()->name }} {{ Auth::user()->last_name }}</span>
                <span> <b>Email:</b> {{ Auth::user()->email }}</span>
            </div>
            <div class="flex flex-row gap-2 mt-1">
                <a href="{{ route('user.edit', Auth::user()->id) }}" class="text-blue-500 hover:underline font-semibold">
                    <span>Edit</span>
                </a>

            </div>

            <div class="flex items-center mt-6">
                <h1 class="text-3xl font-bold text-blue-500">Address Book</h1>
                <h2 class="text-base mt-3 font-bold text-blue-500 ml-8">
                    <a href="{{ route('user.contact.index') }}" class="hover:underline">Manage Addresses</a>
                </h2>
            </div>


            <hr class="border-b border-gray-300 mt-2 mb-2 w-[80%]">

            <!-- Address Section with Flexbox -->
            <div class="flex justify-between gap-6">

                <!-- Default Billing Address -->
                <div class="w-1/2">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Billing Address</h3>
                    @if ($billing)
                    <div class="bg-gray-100 p-4 rounded-lg shadow-sm">
                        <p class="text-gray-700">Name: {{ $billing->firstname }} {{ $billing->lastname }}</p>
                        <p class="text-gray-700">{{ $billing->address }}</p>
                        <p class="text-gray-700">{{ $billing->state }}, {{ $billing->country }}, {{ $billing->zip }}</p>
                        <p class="text-gray-700">Tel: {{ $billing->contact_info }}</p>
                    </div>
                    @else
                    <p class="text-gray-600">You have no default billing address in your address book.</p>
                    @endif
                </div>

                <!-- Default Shipping Address -->
                <div class="w-1/2">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Shipping Address</h3>
                    @if ($shipping)
                    <div class="bg-gray-100 p-4 rounded-lg shadow-sm">
                        <p class="text-gray-700">Name: {{ $shipping->firstname }} {{ $shipping->lastname }}</p>
                        <p class="text-gray-700">{{ $shipping->address }}</p>
                        <p class="text-gray-700">{{ $shipping->state }}, {{ $shipping->country }}, {{ $shipping->zip }}</p>
                        <p class="text-gray-700">Tel: {{ $shipping->contact_info }}</p>
                    </div>
                    @else
                    <p class="text-gray-600">You have no default shipping address in your address book.</p>
                    @endif
                </div>

            </div>



        </div>
    </div>
</div>


<script>
    document.getElementById('dashboard-link').addEventListener('click', function() {
        // If you want to toggle visibility of account info, you can do this:
        document.getElementById('account-info').classList.remove('hidden');
    });

    // Function to toggle the modal visibility
    function toggleModal() {
        const modal = document.getElementById('user-modal');
        modal.classList.toggle('hidden');
    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Search functionality
        const searchInput = document.getElementById('search-user');
        const userList = document.getElementById('user-list');

        // Only add event listener if the search input exists
        if (searchInput && userList) {
            searchInput.addEventListener('keyup', function() {
                const filter = searchInput.value.toLowerCase(); // Get the lowercase input value

                // Get all the user list items
                const userItems = userList.getElementsByClassName('user-item');

                // Loop through the user items and hide/show based on search query
                Array.from(userItems).forEach(item => {
                    const userName = item.querySelector('span').textContent.toLowerCase();

                    if (userName.includes(filter)) {
                        item.style.display = ''; // Show the item
                    } else {
                        item.style.display = 'none'; // Hide the item
                    }
                });
            });
        }
    });
</script>



@endsection