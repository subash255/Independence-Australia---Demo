@extends('layouts.master')
@section('content')

<div class="container mx-auto px-4 py-6">
    <!-- Header Section -->
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">{{$category->name}}</h1>
        <p class="text-gray-600 mt-2">
            Alwayson Medical offers a comprehensive range of Daily Living and Mobility Aids, designed to support individuals of all ages, including children, seniors, and people with disabilities.
        </p>
        <a href="#" class="text-blue-600 underline mt-2 inline-block">Learn More</a>
    </div>

    <!-- Main Content -->
    <div class="flex flex-col lg:flex-row gap-6">
        <!-- Sidebar -->
        <aside class="w-full lg:w-1/4 bg-gray-100 p-4 rounded-md shadow-sm">
            <h2 class="font-semibold text-lg text-gray-800 mb-4">Shop By Category</h2>
            <!-- According Sections for Categories -->
            <div class="space-y-4">
                @foreach($categories as $category)
                <div>
                    <!-- Category Button to Toggle Subcategories -->
                    <a href="{{ route('menu.index', ['id' => $category->id]) }}">
                        <button class="w-full text-left font-semibold text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-md px-2 py-2 flex items-center justify-between border-b border-gray-300">
                            <span class="flex-grow">{{ $category->name }}</span>
                            <i onclick="toggle(event, 'subcategory-{{ $category->id }}')" class="ri-arrow-down-s-line text-gray-600 cursor-pointer"></i>
                        </button>
                    </a>

                    <!-- Subcategory Dropdown (Hidden by Default) -->
                    <div id="subcategory-{{ $category->id }}" class="hidden space-y-2 ml-4 mt-2 transition-all duration-300 ease-in-out">
                        @foreach($category->subcategories as $subcategory)
                        <div class="flex items-center space-x-2">
                            <span class="text-gray-600">{{ optional($subcategory)->name }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
<!-- Shop by Brands Section -->
<h2 class="font-semibold text-lg text-gray-800 mb-4">Shop By Brands</h2>
@foreach($brands as $brand)
    <div class="flex items-center space-x-2">
        <input type="checkbox" name="brand" value="{{ $brand->id }}"
            id="brand-{{ $brand->id }}"
            {{ request('brand') == $brand->id ? 'checked' : '' }}
            class="brand-checkbox">
        <label for="brand-{{ $brand->id }}">{{ $brand->name }}</label>
    </div>
@endforeach

        </aside>
        

        <!-- Product Grid -->
        <main class="w-full lg:w-3/4"  >
           
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @if($subcategories->isNotEmpty())
            @foreach($subcategories as $subcategory)
                <div class="bg-white shadow rounded-md p-4 ">
                    <h3 class="text-lg font-semibold text-gray-800">{{ $subcategory->name }}</h3>
                    <p class="text-gray-600 mt-2">
                        Discover a wide selection of clothing and dressing aids designed to promote independence and comfort.
                    </p>
                    <a href="#" class="text-blue-600 underline mt-2 inline-block">Learn More</a>
                </div>
            @endforeach
        @else
            <p>No subcategories found.</p>
        @endif
    </div>




            <!-- Product Listings -->
            <div class="mt-8">
                <div class="flex items-center justify-between">
                    <p class="text-gray-600">Displaying {{ $products->count() }} of {{ $products->total() }} Items</p>
                    
                    <!-- Form for sorting products -->
                    <form method="GET" action="{{ route('menu.index', $category->id) }}" class="flex items-center">
                        <select name="sort_by" class="border-gray-300 rounded-md shadow-sm" onchange="this.form.submit()">
                            <option value="name_asc" {{ request('sort_by') == 'name_asc' ? 'selected' : '' }}>Sort by Product Name (A-Z)</option>
                            <option value="name_desc" {{ request('sort_by') == 'name_desc' ? 'selected' : '' }}>Sort by Product Name (Z-A)</option>
                            <option value="price_asc" {{ request('sort_by') == 'price_asc' ? 'selected' : '' }}>Sort by Price (Low to High)</option>
                            <option value="price_desc" {{ request('sort_by') == 'price_desc' ? 'selected' : '' }}>Sort by Price (High to Low)</option>
                            <option value="rating_asc" {{ request('sort_by') == 'rating_asc' ? 'selected' : '' }}>Sort by Rating (Low to High)</option>
                            <option value="rating_desc" {{ request('sort_by') == 'rating_desc' ? 'selected' : '' }}>Sort by Rating (High to Low)</option>
                        </select>
                    </form>
                </div>
            
                <!-- Product Grid Layout -->
                <div id="product" class="max-w-7xl mx-auto p-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($products as $product)
                    <a href="{{ route('product.show', ['id' => $product->id]) }}" class="block">
                        <div class="bg-white border rounded-lg p-4 relative shadow hover:shadow-lg transition flex flex-col justify-between h-full">
                            <!-- Product Image with Aspect Ratio Preservation -->
                            <div class="h-48 flex items-center justify-center bg-gray-100 rounded-lg mb-2 overflow-hidden">
                                <img src="{{ asset($product->image) }}" alt="{{ $product->name }} Image" class="object-contain w-full h-full">
                            </div>
            
                            <!-- Product Details -->
                            <div class="flex flex-col justify-between items-center text-center h-full">
                                <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ optional($product)->name }}</h3>
            
                                <!-- Product Price -->
                                <p class="text-lg font-semibold text-gray-900">${{ number_format($product->price, 2) }}</p>
            
                                <!-- Product Ratings -->
                                <div class="flex items-center mb-3 gap-1 text-yellow-500 text-sm justify-center">
                                    <span class="text-pink-500 text-lg">★★★★★</span>
                                    <span class="text-gray-600">{{ $product->rating }} ({{ $product->reviews_count }} Reviews)</span>
                                </div>
            
                                <!-- Add to Cart Button -->
                                <form action="{{ route('user.cart.add', $product->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="inline-block bg-white border-2 border-blue-500 text-blue-500 font-lg font-bold px-4 py-2 rounded-[24px] hover:bg-blue-700 hover:text-white transition-colors mt-2">
                                        Add to Basket
                                    </button>
                                </form>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            
                <!-- Pagination Links -->
                <div class="flex justify-center mt-4">
                    {{ $products->links() }}
                </div>
            
            </div>
            
        </main>
    </div>
</div>



<script>
    // Combined toggle function
    function toggle(event, id) {
        event.preventDefault(); // Prevent default anchor behavior

        const subcategory = document.getElementById(id);
        const icon = event.currentTarget; // Get the icon that was clicked

        if (subcategory) {
            subcategory.classList.toggle('hidden');
        }

        // Toggle the arrow direction
        if (subcategory && !subcategory.classList.contains('hidden')) {
            icon.classList.remove('ri-arrow-down-s-line');
            icon.classList.add('ri-arrow-up-s-line');
        } else {
            icon.classList.remove('ri-arrow-up-s-line');
            icon.classList.add('ri-arrow-down-s-line');
        }
    }
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const brandCheckboxes = document.querySelectorAll('.brand-checkbox');
    
    // Event listener for checkbox changes
    brandCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function () {
            // Ensure only one checkbox is checked at a time
            brandCheckboxes.forEach(box => {
                if (box !== this) {
                    box.checked = false; // Uncheck other checkboxes
                }
            });

            // Trigger the page reload with the selected brand in the URL
            updateProductsBasedOnSelectedBrand();
        });
    });

    // Function to update products based on the selected brand
    function updateProductsBasedOnSelectedBrand() {
        const selectedBrand = Array.from(brandCheckboxes).find(checkbox => checkbox.checked);
        const brandId = selectedBrand ? selectedBrand.value : null;

        // Construct URL with brand filter
        const url = new URL(window.location.href);
        url.searchParams.delete('brand');  // Remove the existing brand parameter
        if (brandId) {
            url.searchParams.append('brand', brandId);  // Append the selected brand to the URL
        }

        // Reload the page with the updated URL (brand filter applied)
        window.location.href = url.toString();
    }
});




</script>


@endsection
