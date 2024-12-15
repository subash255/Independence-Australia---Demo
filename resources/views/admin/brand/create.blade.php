<!-- resources/views/brands/create.blade.php -->

@extends('layouts.admin')

@section('content')
<div class="max-w-2xl mt-40 mx-auto p-4 bg-white rounded-lg shadow-md">
    <h2 class="text-2xl font-semibold mb-4">Create Brand</h2>

    <form action="{{ route('brand.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <!-- Brand Name Field -->
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Brand Name</label>
            <input type="text" name="name" id="name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
        </div>

        <!-- Brand Image Field -->
        <div class="mb-4">
            <label for="image" class="block text-sm font-medium text-gray-700">Brand Image</label>
            <input type="file" name="image" id="image" accept="image/*" class="mt-1 block w-full text-sm text-gray-500 file:py-2 file:px-4 file:border-0 file:rounded-full file:text-sm file:bg-blue-100 hover:file:bg-blue-200" required>
        </div>

        <!-- Submit Button -->
        <div>
            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Create Brand</button>
        </div>
    </form>
</div>
@endsection
