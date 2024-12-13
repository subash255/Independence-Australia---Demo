<!-- resources/views/admin/profile.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-3xl font-semibold mb-6">Admin Profile</h1>

    @if (session('success'))
        <div class="bg-green-500 text-white p-4 rounded-md mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white p-6 rounded-lg shadow-md">
        <!-- Name Display -->
        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-semibold">Name</label>
            <p class="mt-2 p-2 w-full border border-gray-300 rounded-md bg-gray-100">{{ $user->name }}</p>
        </div>

        <!-- Email Display -->
        <div class="mb-4">
            <label for="email" class="block text-gray-700 font-semibold">Email</label>
            <p class="mt-2 p-2 w-full border border-gray-300 rounded-md bg-gray-100">{{ $user->email }}</p>
        </div>

        <div class="mb-4">
            <label for="password" class="block text-gray-700 font-semibold">Password</label>
            <p class="mt-2 p-2 w-full border border-gray-300 rounded-md bg-gray-100">**********</p> <!-- Masked Password -->
        </div>

    </div>
</div>
@endsection
