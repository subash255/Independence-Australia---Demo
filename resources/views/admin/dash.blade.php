@extends('layouts.admin')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Users -->
        <div class="bg-white p-4 shadow rounded-lg">
            <h2 class="text-gray-700 text-lg font-bold">Total Users</h2>
            <p class="text-2xl font-semibold mt-2">6</p>
        </div>

        <!-- Total Rooms -->
        <div class="bg-white p-4 shadow rounded-lg">
            <h2 class="text-gray-700 text-lg font-bold">Total Rooms</h2>
            <p class="text-2xl font-semibold mt-2">4</p>
        </div>

        <!-- Total Bookings -->
        <div class="bg-white p-4 shadow rounded-lg">
            <h2 class="text-gray-700 text-lg font-bold">Total Bookings</h2>
            <p class="text-2xl font-semibold mt-2">2</p>
        </div>

        <!-- Revenue -->
        <div class="bg-white p-4 shadow rounded-lg">
            <h2 class="text-gray-700 text-lg font-bold">Revenue</h2>
            <p class="text-2xl font-semibold mt-2">Rs 2</p>
        </div>
    </div>
@endsection
