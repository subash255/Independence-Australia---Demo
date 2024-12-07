@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
  <!-- Header Section -->
  <div class="flex justify-between items-center mb-8 p-6 bg-white shadow-lg rounded-lg border border-gray-200">
    <h2 class="text-3xl font-semibold text-gray-800">Product List</h2>
    <a href="{{ route('product.create') }}" class="bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 transition duration-300 ease-in-out shadow-md transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-indigo-500">
      Add Product
    </a>
  </div>

  <!-- Table Section -->
  <div class="overflow-x-auto bg-white shadow-lg rounded-lg p-4">
    <table class="min-w-full table-auto border-collapse">
      <thead class="bg-gray-100">
        <tr class="text-left text-sm font-semibold text-gray-600">
          <th class="px-6 py-4">Name</th>
          <th class="px-6 py-4">Price</th>
          <th class="px-6 py-4">Quantity</th>
          <th class="px-6 py-4">Brand</th>
          <th class="px-6 py-4">Image</th>
          <th class="px-16 py-4">Options</th>
        </tr>
      </thead>
      <tbody>
        @foreach($products as $product)
          <tr class="border-b border-gray-200 hover:bg-gray-50 transition duration-300">
            <td class="px-6 py-4 text-sm font-medium text-gray-800">{{ $product->name }}</td>
            <td class="px-6 py-4 text-sm text-gray-600">{{ number_format($product->price, 2) }} USD</td>
            <td class="px-6 py-4 text-sm text-gray-600">{{ $product->quantity }}</td>
            <td class="px-6 py-4 text-sm text-gray-600">{{ $product->brand }}</td>
            <td class="px-6 py-4">
              <img src="{{ asset('/products/'.$product->image) }}" alt="Product Image" class="w-16 h-16 object-cover rounded-lg shadow-sm">
            </td>
            <td class="px-6 py-4">
              <!-- Action Buttons -->
              <div class="flex space-x-4">
                <!-- Edit Button -->
                <a href="{{ route('product.edit', $product->id) }}" class="flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm font-medium hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-300">
                  <i class="fa fa-pencil-alt mr-2"></i><span>Edit</span>
                </a>

                <!-- Delete Button -->
                <form action="{{ route('product.delete', $product->id) }}" method="POST" class="inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="flex items-center px-4 py-2 bg-red-600 text-white rounded-lg text-sm font-medium hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 transition duration-300" onclick="return confirm('Are you sure you want to delete this product?');">
                    <i class="fa fa-trash-alt mr-2"></i><span>Delete</span>
                  </button>
                </form>
              </div>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
