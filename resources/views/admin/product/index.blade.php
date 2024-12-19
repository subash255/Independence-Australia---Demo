@extends('layouts.admin')

@section('content')

{{-- Flash Message --}}
@if(session('success'))
    <div id="flash-message" class="bg-green-500 text-white px-6 py-2 rounded-lg fixed top-4 right-4 shadow-lg z-50">
        {{ session('success') }}
    </div>
@endif

<script>
    if (document.getElementById('flash-message')) setTimeout(() => {
        const msg = document.getElementById('flash-message');
        msg.style.opacity = 0;
        msg.style.transition = "opacity 0.5s ease-out";
        setTimeout(() => msg.remove(), 500);
    }, 3000);
</script>

<!-- Main container -->
<div class="max-w-full mx-auto p-4 bg-white shadow-lg mt-[7rem] rounded-lg relative z-10">
    <div class="mb-4 flex justify-end space-x-4">
        <div class="mr-[27rem] mt-2">
            <a href="{{ route('admin.product.create') }}" class="text-red-500 font-medium bg-white border-2 border-red-500 rounded-lg py-2 px-4 hover:bg-red-600 hover:text-white transition duration-300">Add product</a>
        </div>
        <button class="bg-white border-2 border-blue-700 text-gray-900 px-4 py-2 rounded-md hover:bg-blue-700 hover:text-white" >Pending</button>
        <button class="bg-white border-2 border-green-600 text-gray-900 px-4 py-2 rounded-md hover:bg-green-600 hover:text-white" >Approved</button>
        <button class="bg-white border-2 border-red-600 text-gray-900 px-4 py-2 rounded-md hover:bg-red-600 hover:text-white" >Rejected</button>
    
    </div>

    <div class="flex justify-between mb-4">
        <!-- Left: Show entries with tag above -->
        <div>
            <label for="entries" class="mr-2">Show entries:</label>
            <select id="entries" class="border border-gray-300 px-2 py-1">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="15">15</option>
            </select>
        </div>

        <!-- Right: Search with label beside -->
        <div class="flex items-center space-x-2">
            <span class="text-gray-700">Search:</span>
            <input type="text" id="search" placeholder="Search..." class="border border-gray-300 px-4 py-2 w-96" />
        </div>
    </div>

    <!-- Table Container with horizontal scroll if needed -->
    <div class="overflow-x-auto">
        <table class="min-w-full border-collapse border border-gray-300 table-auto">
            <thead>
                <tr>
                    <th class="border border-gray-300 px-2 py-2 font-medium">S.N</th>
                    <th class="border border-gray-300 px-2 py-2 font-medium">SKU</th>
                    <th class="border border-gray-300 px-2 py-2 font-medium">Photo</th>
                    <th class="border border-gray-300 px-2 py-2 font-medium">Category</th>
                    <th class="border border-gray-300 px-2 py-2 font-medium">Short Description</th>
                    <th class="border border-gray-300 px-7 py-2 font-medium">Name</th>
                   
                    <th class="border border-gray-300 px-7 py-2 font-medium">Brand</th>
                    <th class="border border-gray-300 px-7 py-2 font-medium">Price</th>
                    <th class="border border-gray-300 px-2 py-2 font-medium">Action</th>
                </tr>
            </thead>
            <tbody>
    @foreach ($products as $product)
        <tr class="border border-gray-300 product-row" data-product-id="{{ $product->id }}">
            <td class="border border-gray-300 px-4 py-2">{{ $loop->iteration }}</td>
            <td class="border border-gray-300 px-4 py-2">
                {{ $product->sku }}
            </td>
            <td class="border border-gray-300 px-4 py-2">
                <img src="{{ asset( $product->image) }}" alt="{{ $product->name }}" class="w-16 h-16 object-cover rounded-full" />
            </td>
          
            <td class="border border-gray-300 px-4 py-2">{{$product->category}}</td>
                
            <td class="border border-gray-300 px-4 py-2">
               {{$product->short_description}}
            </td>
            <td class="border border-gray-300 px-7 py-2">{{ $product->name }}</td>
           
            <td class="border border-gray-300 px-4 py-2">
                {{$product->brand}}
            </td>
            <td  class="border border-gray-300 px-4 py-2">
                {{$product->price}}
            </td>
            <td class="px-2 py-2 mt-4 flex justify-center space-x-2">
                <button class="text-white bg-blue-500 hover:bg-blue-700 w-8 h-8 flex items-center justify-center rounded-md" onclick="updateStatus('pending')">
                    <i class="ri-alarm-line text-sm"></i>
                </button>
                <button class="text-white bg-red-500 hover:bg-red-700 w-8 h-8 flex items-center justify-center rounded-md" onclick="updateStatus('rejected')">
                    <i class="ri-close-line text-sm"></i>
                </button>
                <button class="text-white bg-green-500 hover:bg-green-700 w-8 h-8 flex items-center justify-center rounded-md" onclick="updateStatus('approved')">
                    <i class="ri-check-line text-sm"></i>
                </button>
                <a href="{{ route('admin.product.show', $product->id) }}"><button class="text-white bg-green-500 hover:bg-green-700 w-8 h-8 flex items-center justify-center rounded-md">
                    <i class="ri-eye-line text-sm"></i>
                </button></a>
            </td>
        </tr>
    @endforeach
</tbody>
<!-- Modal for inputting remarks -->
<div id="remark-modal" class="fixed flex inset-0 z-30 items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white p-6 rounded-lg max-w-lg w-full">
        <h3 class="text-xl font-semibold mb-4">Enter Remarks</h3>
        <textarea id="remark-input" rows="4" class="border border-gray-300 w-full px-4 py-2" placeholder="Enter remarks..."></textarea>
        <div class="mt-4 flex justify-end space-x-2">
            <button id="submit-remark" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-700">Submit</button>
            <button id="cancel-remark" class="bg-gray-500 text-white py-2 px-4 rounded-md hover:bg-gray-700">Cancel</button>
        </div>
    </div>
</div>


        </table>
    </div>

    <!-- Pagination and Show Entries Section at the Bottom -->
    <div class="flex justify-between items-center mt-4">
        <div class="flex items-center space-x-2">
            <span class="ml-4 text-gray-700">Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} of {{ $products->total() }} entries</span>
        </div>
        <div class="flex items-center space-x-2">
            {{ $products->appends(['status' => request('status')])->links() }}
        </div>
    </div>
</div>













@endsection
