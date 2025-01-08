@extends('layouts.master')
@section('content')


<div class="flex flex-col lg:flex-row"> 
    <!-- Sidebar/Nav Section -->
    <nav class="lg:w-[21%] w-full p-6 font-semibold mt-10 bg-white ">
        <a href="{{ route('user.welcome') }}" class="flex items-center py-4 border-b border-gray-300 transition-colors duration-200 hover:text-blue-500 focus:bg-gray-300 focus:text-blue-500 {{ request()->routeIs('user.welcome') ? 'bg-gray-300 text-blue-500 font-bold' : '' }}">
            <span class="ml-4">Account Dashboard</span>
        </a>
        <a href="{{route('user.myorder')}}" class="flex items-center py-4 border-b border-gray-300 transition-colors duration-200 hover:text-blue-500 focus:bg-gray-300 focus:text-blue-500 {{ request()->routeIs('user.myorder') ? 'bg-gray-300 text-blue-500 font-bold' : '' }}">
            <span class="ml-4">Web Orders</span>
        </a>
        <a href="{{ route('user.contact.index') }}" class="flex items-center py-4 border-b border-gray-300 transition-colors duration-200 hover:text-blue-500 focus:bg-gray-300 focus:text-blue-500 {{ request()->routeIs('user.contact.index') ? 'bg-gray-300 text-blue-500 font-bold' : '' }}">
            <span class="ml-4">My Information</span>
        </a>
        <a href="#" class="flex items-center py-4 border-b border-gray-300 transition-colors duration-200 hover:text-blue-500 focus:bg-gray-300 focus:text-blue-500 {{ request()->routeIs('user.company.profile') ? 'bg-gray-300 text-blue-500 font-bold' : '' }}">
            <span class="ml-4">Company Profile</span>
        </a>
        <!-- Conditionally show User Management link only if the user is a vendor -->
        @if(Auth::user()->role == 'vendor') <!-- Adjust this based on your role check -->
        <a href="{{ route('user.manageuser.index') }}" class="flex items-center py-4 border-b border-gray-300 transition-colors duration-200 hover:text-blue-500 focus:bg-gray-300 focus:text-blue-500 {{ request()->routeIs('user.management') ? 'bg-gray-300 text-blue-500 font-bold' : '' }}">
            <span class="ml-4">User Management</span>
        </a>
        @endif
    </nav>


@endsection
