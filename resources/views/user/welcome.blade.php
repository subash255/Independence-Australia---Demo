@extends('layouts.user')
@section('content')
    <div class="p-6 items-center justify-between bg-cover bg-center" style="background-image: url('/images/dr.jpg');">
        <div class="my-8 ml-8">
            <div class="text-sm text-gray-500">
                <a href="#" class="hover:text-[#00718f]">Home</a> |
                <span>Dashboard</span>
            </div>
            <!-- Welcome Heading -->
            <h1 class="text-5xl font-bold text-[#00718f] mt-2">Welcome {{ Auth::user()->name }}!</h1>

            <hr class="border-b border-gray-300 mt-2 mb-2 w-2/4">
            <p class="text-gray-600 mt-1">
                You are currently managing <br>
                <span class="font-semibold text-[#00718f]">{{ Auth::user()->name }} {{ Auth::user()->last_name }} B2B
                    Customer</span>
            </p>
            <!-- Switch Account Button -->
            <button class="mt-4 flex items-center bg-[#00718f] text-white px-4 py-2 rounded-lg hover:bg-[#00718f]">
                <i class="ri-refresh-line pr-2"></i>
                Switch Account
            </button>
        </div>
    </div>

    <div class="flex">
        <!-- Sidebar/Nav Section -->
        <nav class="w-[21%] bg-white p-6 font-semibold">
            <a href="#" class="flex items-center py-4 border-b border-gray-300  hover:text-[#00718f] transition-colors duration-200 focus:bg-gray-300 focus:text-[#00718f]">
                <span class="ml-4">Account Dashboard</span>
            </a>
            <a href="#" class="flex items-center py-4 border-b border-gray-300  hover:text-[#00718f] transition-colors duration-200 focus:bg-gray-300 focus:text-[#00718f]">
                <span class="ml-4">Web Orders</span>
            </a>
            <a href="#" class="flex items-center py-4 border-b border-gray-300  hover:text-[#00718f] transition-colors duration-200 focus:bg-gray-300 focus:text-[#00718f]">
                <span class="ml-4">My Information</span>
            </a>
            <a href="#" class="flex items-center py-4 border-b border-gray-300  hover:text-[#00718f] transition-colors duration-200 focus:bg-gray-300 focus:text-[#00718f]">
                <span class="ml-4">Company Profile</span>
            </a>
            <a href="#" class="flex items-center py-4 border-b border-gray-300  hover:text-[#00718f] transition-colors duration-200 focus:bg-gray-300 focus:text-[#00718f]">
                <span class="ml-4">User Management</span>
            </a>
        </nav>
        

        <!-- Main Content Section -->
        <div class="w-3/4 p-6">
            <h1 class="text-3xl font-bold text-[#00718f] mt-2">Account Information</h1>
            <hr class="border-b border-gray-300 mt-2 mb-2 w-[80%]">
            <h2 class="text-xl font-bold text-gray-800 mt-2 py-4">Contact Information</h2>
            <div class="flex flex-col">
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
            <div class="flex items-center mt-6">
                <h1 class="text-3xl font-bold text-[#00718f]">Address Book</h1>
                <h2 class="text-base mt-3 font-bold text-[#00718f] ml-8">Manage Addresses</h2>
            </div>
            <hr class="border-b border-gray-300 mt-2 mb-2 w-[80%]">
        </div>
    </div>
@endsection
