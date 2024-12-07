@extends('layouts.admin')

@section('content')
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 p-6">

    <!-- Total Users -->
    <div class="bg-white p-6 shadow-lg rounded-lg flex flex-col items-center justify-center hover:shadow-xl transition-all duration-300">
        <div class="bg-blue-100 p-5 rounded-full mb-4">
            <i class="ri-user-fill text-blue-600 text-4xl"></i>
        </div>
        <h2 class="text-gray-700 text-lg font-semibold">Total Users</h2>
        <p class="text-3xl font-bold mt-2 text-blue-600">6</p>
    </div>

    <!-- Total Deliveries -->
    <div class="bg-white p-6 shadow-lg rounded-lg flex flex-col items-center justify-center hover:shadow-xl transition-all duration-300">
        <div class="bg-green-100 p-5 rounded-full mb-4">
            <i class="ri-truck-fill text-green-600 text-4xl"></i>
        </div>
        <h2 class="text-gray-700 text-lg font-semibold">Total Deliveries</h2>
        <p class="text-3xl font-bold mt-2 text-green-600">4</p>
    </div>

    <!-- Total Products -->
    <div class="bg-white p-6 shadow-lg rounded-lg flex flex-col items-center justify-center hover:shadow-xl transition-all duration-300">
        <div class="bg-yellow-100 p-5 rounded-full mb-4">
            <i class="ri-settings-4-fill text-yellow-600 text-4xl"></i>
        </div>
        <h2 class="text-gray-700 text-lg font-semibold">Total Products</h2>
        <p class="text-3xl font-bold mt-2 text-yellow-600">2</p>
    </div>

    <!-- Revenue -->
    <div class="bg-white p-6 shadow-lg rounded-lg flex flex-col items-center justify-center hover:shadow-xl transition-all duration-300">
        <div class="bg-purple-100 p-5 rounded-full mb-4">
            <i class="ri-money-dollar-circle-fill text-purple-600 text-4xl"></i>
        </div>
        <h2 class="text-gray-700 text-lg font-semibold">Revenue</h2>
        <p class="text-3xl font-bold mt-2 text-purple-600">$20</p>
    </div>

</div>
@endsection
