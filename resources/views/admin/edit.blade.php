@extends('layouts.admin')

@section('content') 

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Page</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

  <div class="bg-white shadow-lg rounded-lg p-6 w-full max-w-4xl">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Edit Item</h2>
    <form action="" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PATCH')
      
      <div class="flex items-start">
        <div>
          <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Image</label>
          <div class="w-32 h-32 bg-gray-100 border border-gray-300 rounded-lg overflow-hidden">
            <img id="previewImage" src="{{ asset('/products/'.$product->image) }}" alt="Item Image" class="w-full h-full object-cover">
          </div>
          <input type="file" id="image" name="image" accept="image/*" 
            class="mt-3 text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
        </div>
        
        <div class="ml-6 flex-1 space-y-4">
        
          <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Product Name</label>
            <input type="text" id="name" name="name" value="{{ $product->name }}" 
              class="mt-1 block w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
          </div>

          <!-- Price -->
          <div>
            <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
            <input type="number"id="price" name="price"value="{{ $product->price }}" 
              class="mt-1 block w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
          </div>

          
          <div>
            <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
            <input type="number" id="quantity" name="quantity" value="{{ $product->quantity }}" 
              class="mt-1 block w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
          </div>

          
          <div>
            <label for="brand" class="block text-sm font-medium text-gray-700">Brand</label>
            <input  type="text"  id="brand"  name="brand" value="{{ $product->brand }}" 
              class="mt-1 block w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
          </div>
        </div>
      </div>

      
      <div class="flex justify-end">
        <button type="submit" 
          class="px-6 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg shadow hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-offset-2">
          Update Item
        </button>
      </div>
    </form>
  </div>

</body>
</html>



@endsection