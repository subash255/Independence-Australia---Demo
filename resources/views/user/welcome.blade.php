@extends('layouts.user')

@section('content')
<div class="flex flex-col lg:flex-row"> 
    <!-- Sidebar/Nav Section -->
    <nav class="lg:w-[21%] w-full p-6 font-semibold mt-10 bg-white border-r border-gray-300">
        <a href="{{ route('user.welcome') }}" class="flex items-center py-4 border-b border-gray-300 transition-colors duration-200 hover:text-[#00718f] focus:bg-gray-300 focus:text-[#00718f] {{ request()->routeIs('user.welcome') ? 'bg-gray-300 text-[#00718f] font-bold' : '' }}">
            <span class="ml-4">Account Dashboard</span>
        </a>
        <a href="#" class="flex items-center py-4 border-b border-gray-300 transition-colors duration-200 hover:text-[#00718f] focus:bg-gray-300 focus:text-[#00718f] {{ request()->routeIs('user.orders.index') ? 'bg-gray-300 text-[#00718f] font-bold' : '' }}">
            <span class="ml-4">Web Orders</span>
        </a>
        <a href="{{ route('user.contact.index') }}" class="flex items-center py-4 border-b border-gray-300 transition-colors duration-200 hover:text-[#00718f] focus:bg-gray-300 focus:text-[#00718f] {{ request()->routeIs('user.contact.index') ? 'bg-gray-300 text-[#00718f] font-bold' : '' }}">
            <span class="ml-4">My Information</span>
        </a>
        <a href="#" class="flex items-center py-4 border-b border-gray-300 transition-colors duration-200 hover:text-[#00718f] focus:bg-gray-300 focus:text-[#00718f] {{ request()->routeIs('user.company.profile') ? 'bg-gray-300 text-[#00718f] font-bold' : '' }}">
            <span class="ml-4">Company Profile</span>
        </a>
        <a href="#" class="flex items-center py-4 border-b border-gray-300 transition-colors duration-200 hover:text-[#00718f] focus:bg-gray-300 focus:text-[#00718f] {{ request()->routeIs('user.management') ? 'bg-gray-300 text-[#00718f] font-bold' : '' }}">
            <span class="ml-4">User Management</span>
        </a>
    </nav>

    <!-- Main Content Section -->
    <div class="lg:w-[79%] w-full p-6 mt-4">
        <div id="account-info">
            <h1 class="text-3xl font-bold text-[#00718f] mt-2">Account Information</h1>
            <hr class="border-b border-gray-300 mt-2 mb-2 w-[80%]">
            <h2 class="text-xl font-bold text-gray-800 mt-2 py-4">Contact Information</h2>
            <div class="flex flex-col space-y-2">
                <span> <b>Company Name:</b> BITS Pvt. Ltd.</span>
                <span> <b>Name:</b> {{ Auth::user()->name }} {{ Auth::user()->last_name }}</span>
                <span> <b>Email:</b> {{ $user->email }}</span>
            </div>
            <div class="flex flex-row gap-2 mt-1">
                <a href="#" class="text-[#00718f] hover:underline hidden sm:block font-semibold">
                    <span>Edit</span>
                </a> |
                <a href="#" class="text-[#00718f] hover:underline hidden sm:block font-semibold">
                    <span>Change Password</span>
                </a>
            </div>

            <!-- Address Book Section -->
            <div class="flex items-center mt-6">
                <h1 class="text-3xl font-bold text-[#00718f]">Address Book</h1>
                <h2 class="text-base mt-3 font-bold text-[#00718f] ml-8">Manage Addresses</h2>
            </div>
            <hr class="border-b border-gray-300 mt-2 mb-2 w-[80%]">
        </div>
    </div>
</div>

<script>
    document.getElementById('dashboard-link').addEventListener('click', function() {
        // If you want to toggle visibility of account info, you can do this:
        document.getElementById('account-info').classList.remove('hidden');
    });
</script>
@endsection
