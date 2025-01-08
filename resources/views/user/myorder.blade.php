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

    <!-- My orders -->
    <div class="container mx-auto mt-16 min-h-screen relative">
        <h1 class="text-3xl font-semibold text-gray-800">My Orders</h1>
        
        @if($orders->isEmpty())
        <p class="mt-4 text-gray-500">You have no orders.</p>
    @else
        <div class="overflow-x-auto mt-8">
            <table class="table-auto w-full border-collapse">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-6 py-3 text-left">Order ID</th>
                        <th class="px-6 py-3 text-left">Date</th>
                        <th class="px-6 py-3 text-left">Total</th>
                        <th class="px-6 py-3 text-left">Status</th>
                        <th class="px-6 py-3 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr class="border-b">
                            <td class="px-6 py-4">{{ $order->id }}</td>
                            <td class="px-6 py-4">{{ $order->created_at->format('d M, Y') }}</td>
                            <td class="px-6 py-4">${{ number_format($order->total, 2) }}</td>
                            <td class="px-6 py-4">{{ ucfirst($order->status) }}</td>
                            <td class="px-6 py-4">
                                <a href="{{ route('order.details', $order->id) }}" class="text-indigo-600 hover:text-indigo-800">View Details</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
    
    </div>
    



@endsection
