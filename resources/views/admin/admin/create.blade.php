@extends('layouts.admin')

@section('content')

<div class="max-w-8xl mx-auto p-6 bg-white shadow-lg mt-[7rem] rounded-lg relative z-10">

    <form method="POST" action="{{ route('admin.store') }}" class="space-y-6">
        @csrf

        <!-- Name Field -->
        <div class="flex flex-col">
            <label for="name" class="text-lg text-gray-700">Name</label>
            <input type="text" name="name" id="name" class="mt-2 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
        </div>

        <!-- Email Field -->
        <div class="flex flex-col">
            <label for="email" class="text-lg text-gray-700">Email</label>
            <input type="email" name="email" id="email" class="mt-2 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
        </div>

        <!-- Password Field -->
        <div class="flex flex-col">
            <label for="password" class="text-lg text-gray-700">Password</label>
            <input type="password" name="password" id="password" class="mt-2 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
        </div>

        <!-- Confirm Password Field -->
        <div class="flex flex-col">
            <label for="password_confirmation" class="text-lg text-gray-700">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="mt-2 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="w-full py-3 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700 transition duration-300">
            Create Admin
        </button>
    </form>
</div>

@endsection
