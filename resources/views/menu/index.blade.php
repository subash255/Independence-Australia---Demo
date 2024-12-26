@extends('layouts.master')
@section('content')

<div class="container mx-auto px-4 py-6">
    <!-- Header Section -->
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Daily Living & Mobility Aids</h1>
        <p class="text-gray-600 mt-2">
            Independence Australia stocks a large range of Daily Living and Mobility Aids for children, the elderly, and people living with disabilities.
        </p>
        <a href="#" class="text-blue-600 underline mt-2 inline-block">Read More</a>
    </div>

    <!-- Main Content -->
    <div class="flex flex-col lg:flex-row gap-6">
        <!-- Sidebar -->
        <aside class="w-full lg:w-1/4 bg-gray-100 p-4 rounded-md shadow-sm">
            <h2 class="font-semibold text-lg text-gray-800 mb-4">Shop By</h2>
            <!-- Accordion Sections -->
            <div class="space-y-4">
    @foreach($categories as $category)
    <div>
        <!-- Category button to toggle dropdown -->
        <button onclick="toggle('subcategory-{{ $category->id }}')" class="w-full text-left font-semibold text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-md px-4 py-2 flex items-center justify-between">
            <span>{{ $category->name }}</span>
            <!-- Dropdown icon -->
            <i class="ri-arrow-down-s-line text-gray-600"></i>
        </button>

        <!-- Dropdown with subcategories, hidden by default -->
        <div id="subcategory-{{ $category->id }}" class="hidden space-y-2 ml-4 mt-2 transition-all duration-300 ease-in-out">
            @foreach($category->subcategories as $subcategory)
            <div class="flex items-center space-x-2">
                <span class="text-gray-600">{{ $subcategory->name }}</span>
            </div>
            @endforeach
        </div>
    </div>
    @endforeach
</div>
                
            </div>
        </aside>

        <!-- Product Grid -->
        <main class="w-full lg:w-3/4">
            <!-- Product Categories -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-white shadow rounded-md p-4">
                    <h3 class="text-lg font-semibold text-gray-800">Clothing & Dressing Aids</h3>
                    <p class="text-gray-600 mt-2">
                        Independence Australia stocks a large range of clothing and dressing aids to ensure you have...
                    </p>
                    <a href="#" class="text-blue-600 underline mt-2 inline-block">Read more</a>
                </div>
                <div class="bg-white shadow rounded-md p-4">
                    <h3 class="text-lg font-semibold text-gray-800">Walking & Mobility Aids</h3>
                    <p class="text-gray-600 mt-2">
                        Live comfortably and feel confident completing tasks in the kitchen with Independence Aust...
                    </p>
                    <a href="#" class="text-blue-600 underline mt-2 inline-block">Read more</a>
                </div>
                <div class="bg-white shadow rounded-md p-4">
                    <h3 class="text-lg font-semibold text-gray-800">Household Aids</h3>
                    <p class="text-gray-600 mt-2">
                        Independence Australia's stock of household aids helps make completing daily...
                    </p>
                    <a href="#" class="text-blue-600 underline mt-2 inline-block">Read more</a>
                </div>
                <!-- Add more cards as needed -->
            </div>

            <!-- Product Listing -->
            <div class="mt-8">
                <div class="flex items-center justify-between">
                    <p class="text-gray-600">324 Items</p>
                    <select class="border-gray-300 rounded-md shadow-sm">
                        <option>Price</option>
                        <option>Rating</option>
                    </select>
                </div>
                <div class="max-w-7xl mx-auto p-6 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach($products as $product)
                    <a href="{{ route('product.show', ['id' => $product->id]) }}" class="block">
                        <div class="bg-white border rounded-lg p-4 relative shadow hover:shadow-lg transition flex flex-col justify-between h-full">
                            <div class="absolute top-2 left-2 bg-orange-500 text-white text-xs font-bold px-2 py-1 rounded">Featured</div>
                            <!-- Image container with fixed aspect ratio and no cropping -->
                            <div class="h-48 flex items-center justify-center bg-gray-100 rounded-lg mb-2 overflow-hidden">
                                <img src="{{ asset($product->image) }}" alt="Product Image" class="object-contain w-full h-full">
                            </div>
                            <div class="flex flex-col justify-between items-center text-center h-full">
                                <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $product->name }}</h3>
                                <p class="text-sm text-gray-900">
                                    <span class="font-bold">{{ $product->brand->name }}</span> 
                                </p>
                                <div class="flex items-center mb-3 gap-1 text-yellow-500 text-sm justify-center">
                                    <span class="text-pink-500 text-lg">★★★★★</span>
                                    <span class="text-gray-600">(5 Reviews)</span>
                                </div>
                                <p class="text-lg font-semibold text-gray-900">${{ number_format($product->price, 2) }}</p>
                                <form action="{{ route('user.cart.add', $product->id) }}" method="POST">
                                    @csrf
                                <button type="submit" class="inline-block bg-white border-2 border-[#00718f] text-[#00718f] font-lg font-bold px-4 py-2 rounded-[24px] hover:bg-[#00718f] hover:text-white transition-colors mt-2">
                                    Add to Basket
                                </button>
                                </form>
                                {{-- <div class="flex gap-4 mt-4">
                                    <span class="text-[#00718f] text-lg">
                                        <i class="ri-heart-line"></i> Add Favourites
                                    </span>
                                    <span class="text-green-700 text-lg">
                                        <i class="ri-arrow-left-right-fill"></i> Add to Compare
                                    </span>
                                </div> --}}
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </main>
    </div>
</div>

<script>
    // Toggle the dropdown and animate the arrow
    function toggle(id) {
        const dropdown = document.getElementById(id);
        const icon = dropdown.previousElementSibling.querySelector('i');

        if (dropdown.classList.contains('hidden')) {
            dropdown.classList.remove('hidden');
            icon.classList.remove('ri-arrow-down-s-line');
            icon.classList.add('ri-arrow-up-s-line');
        } else {
            dropdown.classList.add('hidden');
            icon.classList.remove('ri-arrow-up-s-line');
            icon.classList.add('ri-arrow-down-s-line');
        }
    }
</script>
@endsection
