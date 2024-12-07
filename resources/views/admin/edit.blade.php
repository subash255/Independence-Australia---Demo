@extends('layouts.admin')

@section('content')
<div class="bg-gray-100 min-h-screen flex items-center justify-center py-8 px-4">

  <div class="bg-white shadow-xl rounded-lg p-8 w-full max-w-4xl">
    <h2 class="text-3xl font-semibold text-gray-800 mb-6">Edit Product</h2>
    <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
      @csrf
      @method('PATCH')

      <!-- Image Upload Section -->
      <div class="flex flex-wrap items-center space-x-6">
        <div class="flex-shrink-0">
          <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Product Image</label>
          <div class="w-40 h-40 bg-gray-100 border border-gray-300 rounded-lg overflow-hidden">
            <img id="previewImage" src="{{ asset('/products/'.$product->image) }}" alt="Product Image" class="w-full h-full object-cover">
          </div>
          <input type="file" id="image" name="image" accept="image/*" 
            class="mt-3 text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 focus:outline-none">
        </div>

        <!-- Product Details Section -->
        <div class="flex-1 space-y-4">
          <!-- Product Name -->
          <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Product Name</label>
            <input type="text" id="name" name="name" value="{{ $product->name }}" 
              class="mt-1 block w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Enter product name">
          </div>

          <!-- Price -->
          <div>
            <label for="price" class="block text-sm font-medium text-gray-700">Price (USD)</label>
            <input type="number" id="price" name="price" value="{{ $product->price }}" 
              class="mt-1 block w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Enter price">
          </div>

          <!-- Quantity -->
          <div>
            <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
            <input type="number" id="quantity" name="quantity" value="{{ $product->quantity }}" 
              class="mt-1 block w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Enter quantity">
          </div>

          <!-- Brand -->
          <div>
            <label for="brand" class="block text-sm font-medium text-gray-700">Brand</label>
            <input type="text" id="brand" name="brand" value="{{ $product->brand }}" 
              class="mt-1 block w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Enter brand name">
          </div>
        </div>
      </div>

      <!-- Submit Button -->
      <div class="flex justify-end">
        <button type="submit" 
          class="px-6 py-3 bg-indigo-600 text-white text-lg font-medium rounded-lg shadow-md hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-offset-2 transition duration-300">
          Update Product
        </button>
      </div>
    </form>
  </div>
</div>
@endsection
