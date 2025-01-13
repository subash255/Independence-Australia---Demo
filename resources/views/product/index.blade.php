@extends('layouts.master')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Header Section -->
   

<!-- Main Content -->
<div class="flex flex-col lg:flex-row gap-6">
    <!-- Sidebar (Hidden by Default on Mobile) -->
    <aside id="sidebar" class="w-full lg:w-1/4 bg-gray-100 p-4 rounded-md shadow-sm lg:block hidden">
        <h2 class="font-semibold text-lg text-gray-800 mb-4">Shop By Category</h2>
        <div class="space-y-4">
            @foreach ($categories as $category)
                <div>
                    <a href="{{ route('menu.index', ['id' => $category->id]) }}">
                        <button
                            class="w-full text-left font-semibold text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-md px-2 py-2 flex items-center justify-between border-b border-gray-300">
                            <span class="flex-grow">{{ $category->name }}</span>
                            <i onclick="toggle(event, 'subcategory-{{ $category->id }}')"
                                class="ri-arrow-down-s-line text-gray-600 cursor-pointer"></i>
                        </button>
                    </a>

                    <div id="subcategory-{{ $category->id }}"
                        class="hidden space-y-2 ml-4 mt-2 transition-all duration-300 ease-in-out">
                        @foreach ($category->subcategories as $subcategory)
                            <div class="flex items-center space-x-2">
                                <span class="text-gray-600">{{ optional($subcategory)->name }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>

        <h2 class="font-semibold text-xl text-gray-900 mb-6 mt-6">Shop By Brands</h2>
        <div id="brands-section" class="space-y-4">
            @foreach ($brands as $index => $brand)
                <div class="flex items-center space-x-3 brand-item" id="brand-{{ $index }}"
                    style="display: {{ $index < 10 ? 'block' : 'none' }}">
                    <input type="checkbox" name="brand" value="{{ $brand->id }}" id="brand-{{ $brand->id }}"
                        {{ request('brand') == $brand->id ? 'checked' : '' }} class="brand-checkbox">
                    <label for="brand-{{ $brand->id }}" class="text-gray-700">{{ $brand->name }}</label>
                </div>
            @endforeach
        </div>

        <!-- Show More / Show Less Button -->
        <div class="mt-4 text-center">
            <button id="show-more-btn" class="text-blue-600 hover:text-blue-800 focus:outline-none">
                Show More
            </button>
            <button id="show-less-btn" class="text-blue-600 hover:text-blue-800 focus:outline-none mt-2"
                style="display: none;">
                Show Less
            </button>
        </div>
    </aside>

    <!-- Product Grid -->
    <main class="w-full lg:w-3/4">

        <!-- Product Count and Sort Form -->
        <div class="flex items-center justify-between mb-6 flex-wrap">
            <!-- Filter Button for Mobile -->
            <div class="lg:hidden w-full mb-4">
                <button id="filter-toggle-btn"
                    class="bg-blue-600 text-white py-2 px-4 rounded-md w-full text-center">
                    Filter
                </button>
            </div>

            <!-- Display Product Count (Mobile & Desktop) -->
            <p class="text-gray-600 w-full lg:w-auto mb-2 lg:mb-0 text-center lg:text-left">
                Displaying {{ $products->count() }} of {{ $products->total() }} Items
            </p>

            <!-- Sort Dropdown (Mobile & Desktop) -->
            <form method="GET" action="{{ route('menu.index', $category->id) }}"
                class="flex items-center w-full lg:w-auto">
                <select name="sort_by" class="border-gray-300 rounded-md shadow-sm w-full lg:w-auto"
                    onchange="this.form.submit()">
                    <option value="name_asc" {{ request('sort_by') == 'name_asc' ? 'selected' : '' }}>Sort by
                        Product Name (A-Z)</option>
                    <option value="name_desc" {{ request('sort_by') == 'name_desc' ? 'selected' : '' }}>Sort by
                        Product Name (Z-A)</option>
                    <option value="price_asc" {{ request('sort_by') == 'price_asc' ? 'selected' : '' }}>Sort by
                        Price (Low to High)</option>
                    <option value="price_desc" {{ request('sort_by') == 'price_desc' ? 'selected' : '' }}>Sort by
                        Price (High to Low)</option>
                    {{-- <option value="rating_asc" {{ request('sort_by') == 'rating_asc' ? 'selected' : '' }}>Sort by
                        Rating (Low to High)</option>
                    <option value="rating_desc" {{ request('sort_by') == 'rating_desc' ? 'selected' : '' }}>Sort by
                        Rating (High to Low)</option> --}}
                </select>
            </form>
        </div>
            <div class="mt-8">
                
                <div class="max-w-7xl mx-auto p-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($products as $product)
                        <a href="{{ route('product.show', ['id' => $product->id]) }}" class="block">
                            <div class="bg-white border rounded-lg p-4 relative shadow hover:shadow-lg transition flex flex-col justify-between h-full">
                                <div class="h-48 flex items-center justify-center bg-gray-100 rounded-lg mb-2 overflow-hidden">
                                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }} Image" class="object-contain w-full h-full">
                                </div>
                                <div class="flex flex-col justify-between items-center text-center h-full">
                                    <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $product->name }}</h3>
                                    <p class="text-lg font-semibold text-gray-900">${{ number_format($product->price, 2) }}</p>
                                    <div class="flex items-center mb-3 gap-1 text-red-500 text-sm font-medium justify-center">

                                        @php
                                            $productReviews = $reviews[$product->id] ?? collect();
                                            $averageRating = $productReviews->avg('rating');
                                        @endphp
                                        @if ($productReviews->count() > 0)
                                            <!-- Display stars based on average rating -->
                                            @for ($i = 0; $i < round($averageRating); $i++)
                                                <i class="ri-star-fill text-yellow-400 text-xl"></i>
                                            @endfor
                                            @for ($i = round($averageRating); $i < 5; $i++)
                                                <i class="ri-star-line text-gray-300 text-xl"></i>
                                            @endfor
                                        @else
                                            <p>No reviews for this product yet.</p>
                                        @endif
        
        
                                    </div>
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
    // Toggle Sidebar visibility on mobile
    document.getElementById('filter-toggle-btn').addEventListener('click', function() {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('hidden');

                // Scroll to the filter section after the toggle
                if (!sidebar.classList.contains('hidden')) {
            sidebar.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    });

    // Combined toggle function for subcategories (unchanged)
    function toggle(event, id) {
        event.preventDefault();
        const subcategory = document.getElementById(id);
        const icon = event.currentTarget;

        if (subcategory) {
            subcategory.classList.toggle('hidden');
        }

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

<script>
    // Number of brands displayed initially
    let brands = document.querySelectorAll('.brand-item');
    let brandsDisplayed = 10;  // Initially, we show 10 brands

    // Show More Button
    document.getElementById('show-more-btn').addEventListener('click', function() {
        // Show all brands
        for (let i = 10; i < brands.length; i++) {
            brands[i].style.display = 'block';
        }

        // Hide Show More button since all brands are shown
        document.getElementById('show-more-btn').style.display = 'none';

        // Show Show Less button after showing all brands
        document.getElementById('show-less-btn').style.display = 'inline-block';
    });

    // Show Less Button
    document.getElementById('show-less-btn').addEventListener('click', function() {
        // Hide brands beyond the first 10
        for (let i = 10; i < brands.length; i++) {
            brands[i].style.display = 'none';
        }

        // Reset brandsDisplayed to 10
        brandsDisplayed = 10;

        // Show Show More button again
        document.getElementById('show-more-btn').style.display = 'inline-block';

        // Hide Show Less button when only the first 10 are shown
        document.getElementById('show-less-btn').style.display = 'none';
    });
</script>


@endsection
