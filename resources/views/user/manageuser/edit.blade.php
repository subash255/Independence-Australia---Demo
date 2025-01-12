@extends('layouts.master')

@section('content')
<div class="flex flex-col lg:flex-row">
    {{-- Sidebar/Nav Section --}}
    @include('user.nav')

    <div class="flex-1 p-6 max-w-4xl mx-auto bg-white rounded-lg">
        <h2 class="text-3xl font-semibold mt-7 mb-6 text-gray-800">Edit User</h2>

        <form action="{{ route('user.manageuser.update', $user->id) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="mb-6">
                <label for="name" class="block text-lg font-medium text-gray-700">Name</label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" 
                    class="mt-2 block w-full px-4 py-2 border-2 border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300"
                    required>
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="email" class="block text-lg font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                    class="mt-2 block w-full px-4 py-2 border-2 border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300"
                    required>
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-between items-center mt-8">
                <button type="submit" class="bg-blue-600 text-white py-3 px-8 rounded-lg font-semibold hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition duration-300 ease-in-out shadow-md hover:shadow-lg">
                    Update User
                </button>
                <a href="{{ route('user.manageuser.index') }}" class="inline-block text-sm py-3 px-8 rounded-lg bg-red-600 text-white font-semibold hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50 transition duration-300 ease-in-out shadow-md hover:shadow-lg">
                    Cancel
                </a>
            </div>
            
            
        </form>
    </div>
</div>
@endsection
