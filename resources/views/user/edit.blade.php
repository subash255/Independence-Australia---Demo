@extends('layouts.master')

@section('content')
    <div class="container mx-auto p-6">
        <div class="flex flex-col md:flex-row gap-6">
            {{-- Sidebar/Nav Section --}}
            @include('user.nav')


            <!-- User Edit Form -->
            <div class="w-full md:w-3/4 lg:w-4/5 bg-white p-8 rounded-lg shadow-md">
                <h1 class="text-2xl font-semibold text-gray-700 mb-6">Edit User</h1>

                <form action="{{ route('user.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <!-- Name -->
                    <div class="form-group mb-6">
                        <label for="name" class="block text-sm font-medium text-gray-600">Name</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            id="name" placeholder="Enter your full name">
                        @error('name')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="form-group mb-6">
                        <label for="email" class="block text-sm font-medium text-gray-600">Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            id="email" placeholder="Enter your email address">
                        @error('email')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="form-group mb-6">
                        <label for="password" class="block text-sm font-medium text-gray-600">Password</label>
                        <input type="password" name="password"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            id="password" placeholder="Enter new password ">
                        @error('password')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="form-group mb-6">
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-600">Confirm
                            Password</label>
                        <input type="password" name="password_confirmation"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            id="password_confirmation" placeholder="Confirm your new password">
                        @error('password_confirmation')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                        class="w-full py-3 mt-4 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                        Update Profile
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
