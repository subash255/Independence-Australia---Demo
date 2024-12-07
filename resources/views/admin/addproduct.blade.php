@extends('layouts.admin')

@section('content')

<div class="min-h-screen flex items-center justify-center py-8 px-4">

    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <h2 class="text-2xl font-bold mb-4 text-gray-700 text-center">Add Product</h2>

        <!-- Display Success Message -->
        @if(session('success'))
            <div class="p-4 mb-4 bg-green-100 text-green-800 border border-green-300 rounded-lg">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <!-- Form -->
        <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <!-- Product Name -->
            <div>
                <label for="name" class="block text-gray-600 font-medium">Product Name</label>
                <input type="text" name="name" id="name" 
                    class="w-full mt-1 p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Enter product name" required>
            </div>

            <!-- Price -->
            <div>
                <label for="price" class="block text-gray-600 font-medium">Price</label>
                <input type="number" name="price" id="price" step="0.01"
                    class="w-full mt-1 p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Enter product price" required>
            </div>

            <!-- Quantity -->
            <div>
                <label for="quantity" class="block text-gray-600 font-medium">Quantity</label>
                <input type="number" name="quantity" id="quantity" min="1"
                    class="w-full mt-1 p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Enter product quantity" required>
            </div>

            <!-- Brand -->
            <div>
                <label for="brand" class="block text-gray-600 font-medium">Brand</label>
                <input type="text" name="brand" id="brand" 
                    class="w-full mt-1 p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Enter brand name" required>
            </div>

            <!-- Product Image Upload -->
            <div>
                <label for="image" class="block text-gray-600 font-medium">Product Image</label>
                <input type="file" name="photopath" id="image" 
                    class="w-full mt-1 p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Submit Button -->
            <button type="submit"
                class="w-full bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-lg transition">
                Add Product
            </button>
        </form>
    </div>
</div>

@endsection
