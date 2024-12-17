@extends('layouts.user')
@section('content')


<div class="bg-white shadow-md p-6 flex items-center justify-between">
    <div>
        <!-- Breadcrumb -->
        <nav class="text-sm text-gray-500">
            <a href="#" class="hover:text-blue-600">Home</a> |
            <span>Dashboard</span>
        </nav>
        <!-- Welcome Heading -->
        <h1 class="text-3xl font-bold text-blue-800 mt-2">Welcome Joshua!</h1>
        <p class="text-gray-600 mt-1">
            You are currently managing <span class="font-semibold text-blue-700">Joshua Dean B2B Customer</span>
        </p>
        <!-- Switch Account Button -->
        <button class="mt-4 flex items-center bg-blue-700 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path d="M9 12H3a1 1 0 110-2h6V6a1 1 0 112 0v4h6a1 1 0 110 2h-6v4a1 1 0 11-2 0v-4z"/>
            </svg>
            Switch Account
        </button>
    </div>
    <!-- Right Side Image -->
    <div>
        <img src="https://via.placeholder.com/150" alt="Heart" class="h-32 rounded-lg">
    </div>
</div>


@endsection
