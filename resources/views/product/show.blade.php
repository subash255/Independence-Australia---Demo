@extends('layouts.master')

@section('content')
<!-- Product Detail Section -->
<div class="max-w-7xl mx-auto px-6 py-12">
    <!-- Breadcrumb -->
    <nav class="text-sm mb-6 text-gray-600">
        <a href="/" class="hover:text-[#00718f] transition">Home</a> / 
        <span class="font-semibold text-gray-800">{{ $product->name }}</span>
    </nav>

    <!-- Product Details Section -->
    <div class="flex flex-col md:flex-row bg-white  rounded-lg p-6 md:p-8 space-y-6 md:space-y-0">
        <!-- Image -->
        <div class="md:w-1/2 flex flex-col items-center">
            @if($product->is_featured) 
            <span class="inline-block bg-orange-500 text-white text-xs px-3 py-1 mt-4 rounded-full">Featured</span>
            @endif
            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="rounded-md w-full max-w-sm">
        </div>

        <!-- Product Info -->
        <div class="md:w-1/2 md:pl-12 space-y-6"> <!-- Added more padding here and space between elements -->
            <!-- Product Name -->
            <h1 class="text-3xl font-extrabold text-gray-900 mb-3 leading-tight">{{ $product->name }}</h1>
            <p class="text-lg text-gray-600 mt-4">{!! $product['short_description'] !!}</p>

            <!-- Availability Status -->
            <p class="text-lg font-semibold mb-4">
                <span class="{{ $product->in_stock ? 'text-green-600' : 'text-red-600' }}">
                    {{ $product->in_stock ? 'IN STOCK' : 'OUT OF STOCK' }}
                </span>
            </p>

            <!-- Price -->
            <p class="text-3xl font-bold text-gray-900 mb-6">
                ${{ number_format($product->price, 2) }}
            </p>

            <!-- Quantity Selector -->
            <div class="flex items-center mb-6 space-x-4">
                <label for="qty" class="text-lg text-gray-700 font-medium">Qty:</label>
                <input type="number" id="qty" class="w-24 border border-gray-300 rounded-md px-4 py-2 text-lg focus:ring-2 focus:ring-blue-500 transition-all" value="1" min="1">

                <form action="{{ route('user.cart.add', $product->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="py-[10px] px-[20px] bg-[#00718f] text-white font-bold rounded-[24px] border-2 border-[#00718f] hover:bg-[#ffffff] hover:text-[#00718f] transition">
                        Add to Basket
                    </button>
                </form>
            </div>

            <!-- Action Buttons (Add to Favorites / Add to Compare) -->
            <div class="flex space-x-6 mt-8">
                <span class="flex items-center text-[#00718f] text-lg font-medium cursor-pointer hover:text-blue-500 transition">
                    <i class="ri-heart-line text-xl mr-2"></i> Add to Favourites
                </span>
                <span class="flex items-center text-green-700 text-lg font-medium cursor-pointer hover:text-green-500 transition">
                    <i class="ri-arrow-left-right-fill text-xl mr-2"></i> Add to Compare
                </span>
            </div>
        </div>
    </div>

    <div class="container mx-auto p-4">
        <!-- Tabs Section -->
        <div class="border-b border-gray-300">
          <ul class="flex space-x-6">
            <li class="pb-2 border-b-2 text-xl border-teal-500 text-teal-600 font-semibold">
              <a href="#">Description</a>
            </li>
            {{-- <li class="pb-2 text-gray-600 hover:text-teal-600">
              <a href="#">Reviews <span class="bg-green-500 text-white text-sm rounded-full px-2 ml-1">6</span></a>
            </li>
            <li class="pb-2 text-gray-600 hover:text-teal-600">
              <a href="#">Shipping & Returns</a>
            </li> --}}
          </ul>
        </div>
      
        <!-- Content Section -->
        <div class="flex flex-col md:flex-row mt-6 space-y-4 md:space-y-0 md:space-x-8">
          <!-- Left Section -->
          <div class="md:w-2/3">
            <h2 class="text-lg font-semibold">{{ $product->name }}</h2>
            <p class="text-gray-700 mt-2">
                {!! $product->description !!}
            </p>
          </div>
      
          <!-- Right Section -->
          <div class="md:w-1/3 p-2">
            <h3 class="text-lg font-semibold mb-4">Specifications</h3>
            <ul class="space-y-2">
              <li class="flex space-x-[5rem] text-gray-700">
                <span>Brand</span>
                <span class="font-semibold">{{ $product->brand->name }}</span>
              </li>
            </ul>
          </div>
        </div>
      </div>
      
</div>
@endsection
