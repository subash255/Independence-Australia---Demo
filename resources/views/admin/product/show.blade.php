@extends('layouts.admin')

@section('content')


<div class="max-w-full mx-auto p-4 bg-white shadow-lg mt-[7rem] rounded-lg relative z-10">

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Product Information Section -->
        <div class="border border-gray-300 p-6 rounded-lg shadow-lg">
            <h3 class="text-2xl font-semibold text-gray-700 mb-4 underline">Product Information</h3>
            <div class="space-y-4">
                <div>
                    <p class="text-gray-500"><strong class="font-medium text-gray-800">Product Name:</strong> {{ $product->product_name }}</p>
                </div>
                <div>
                    <p class="text-gray-500"><strong class="font-medium text-gray-800">Category:</strong> {{ $product->category ? $product->category->category_name : 'No Category' }}</p>
                </div>
                <div>
                    <p class="text-gray-500"><strong class="font-medium text-gray-800">Subcategory:</strong> {{ $product->subcategory ? $product->subcategory->subcategory_name : 'No Subcategory' }}</p>
                </div>
                <div>
                    <p class="text-gray-500"><strong class="font-medium text-gray-800">Remarks:</strong> {{ $product->remark ?? 'No remarks available' }}</p>
                </div>
                <div>
                    <p class="text-gray-500"><strong class="font-medium text-gray-800">Visibility:</strong> {{ $product->visibility ? 'Visible' : 'Hidden' }}</p>
                </div>
                <div>
                    <p class="text-gray-500"><strong class="font-medium text-gray-800">Is Flash:</strong> {{ $product->is_flash ? 'Yes' : 'No' }}</p>
                </div>
                <div>
                    <p class="text-gray-500"><strong class="font-medium text-gray-800">Status:</strong> {{ ucfirst($product->status) }}</p>
                </div>
                <div>
                    <p class="text-gray-500"><strong class="font-medium text-gray-800">Created At:</strong> {{ $product->created_at->format('d M, Y') }}</p>
                </div>
            </div>
        </div>

        <!-- Product Image Section -->
        <div class="border border-gray-300 p-6 rounded-lg shadow-lg">
            <h3 class="text-2xl font-semibold text-gray-700 mb-4 underline">Product Image</h3>
            <div class="flex justify-center">
                <img src="{{ asset('products/' . $product->image) }}" alt="{{ $product->product_name }}" class="w-full h-auto mt-[5rem] object-contain rounded-lg shadow-lg">
            </div>
        </div>
    </div>

</div>

@endsection
