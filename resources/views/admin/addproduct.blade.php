@extends('layouts.admin')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-md">
            <h2 class="text-2xl font-bold mb-4 text-gray-700 text-center">Add Product</h2>
            <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                
                <div>
                    <label for="name" class="block text-gray-600 font-medium">Product Name</label>
                    <input type="text" name="name" id="name" 
                        class="w-full mt-1 p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Enter product name" required>
                </div>

                
                <div>
                    <label for="price" class="block text-gray-600 font-medium">Price</label>
                    <input type="number" name="price" id="price" step="0.01"
                        class="w-full mt-1 p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Enter product price" required>
                </div>

                
                <div>
                    <label for="quantity" class="block text-gray-600 font-medium">Quantity</label>
                    <input type="number" name="quantity" id="quantity" min="1"
                        class="w-full mt-1 p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Enter product quantity" required>
                </div>
                    
                <div>
                    <label for="brand" class="block text-gray-600 font-medium">Type Brand Name</label>
                    <input type="text" name="brand" id="brand" 
                        class="w-full mt-1 p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Enter brand name" required>
                </div>

                
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
</body>
</html>







@endsection