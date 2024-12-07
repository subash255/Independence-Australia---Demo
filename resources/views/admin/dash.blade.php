@extends('layouts.admin')

@section('content')
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 p-6">

    <!-- Total Users -->
    <div class="bg-white p-6 shadow-lg rounded-lg flex flex-col items-center justify-center hover:shadow-xl transition-all duration-300">
        <div class="bg-blue-100 p-4 rounded-full mb-4">
            <i class="fas fa-users text-blue-600 text-3xl"></i>
        </div>
        <h2 class="text-gray-700 text-lg font-semibold">Total Users</h2>
        <p class="text-3xl font-bold mt-2 text-blue-600">6</p>
    </div>

    <!-- Total Rooms -->
    <div class="bg-white p-6 shadow-lg rounded-lg flex flex-col items-center justify-center hover:shadow-xl transition-all duration-300">
        <div class="bg-green-100 p-4 rounded-full mb-4">
            <i class="fas fa-bed text-green-600 text-3xl"></i>
        </div>
        <h2 class="text-gray-700 text-lg font-semibold">Total Rooms</h2>
        <p class="text-3xl font-bold mt-2 text-green-600">4</p>
    </div>

    <!-- Total Bookings -->
    <div class="bg-white p-6 shadow-lg rounded-lg flex flex-col items-center justify-center hover:shadow-xl transition-all duration-300">
        <div class="bg-yellow-100 p-4 rounded-full mb-4">
            <i class="fas fa-calendar-check text-yellow-600 text-3xl"></i>
        </div>
        <h2 class="text-gray-700 text-lg font-semibold">Total Bookings</h2>
        <p class="text-3xl font-bold mt-2 text-yellow-600">2</p>
    </div>

    <!-- Revenue -->
    <div class="bg-white p-6 shadow-lg rounded-lg flex flex-col items-center justify-center hover:shadow-xl transition-all duration-300">
        <div class="bg-purple-100 p-4 rounded-full mb-4">
            <i class="ri-money-dollar-circle-fill text-purple-600 text-3xl"></i>
        </div>
        <h2 class="text-gray-700 text-lg font-semibold">Revenue</h2>
        <p class="text-3xl font-bold mt-2 text-purple-600">Rs 2</p>
    </div>

</div>

@endsection
