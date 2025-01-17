@extends('layouts.master')
@section('content')
    {{-- Flash Message --}}
    @if (session('success'))
        <div id="flash-message" class="bg-green-500 text-white px-6 py-2 rounded-lg fixed top-4 right-4 shadow-lg z-50">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div id="flash-message" class="bg-red-500 text-white px-6 py-2 rounded-lg fixed top-4 right-4 shadow-lg z-50">
            {{ session('error') }}
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

    <!-- Product Detail Section -->
    <div class="max-w-7xl mx-auto px-6 py-12">
        <!-- Breadcrumb -->
        <nav class="text-sm mb-6 text-gray-600">
            <a href="/" class="hover:text-blue-700 transition">Home</a> /
            <span class="font-semibold text-gray-800">{{ $product->name }}</span>
        </nav>

        <!-- Product Details Section -->
        <div class="flex flex-col md:flex-row bg-white  rounded-lg p-6 md:p-8 space-y-6 md:space-y-0">
            <!-- Image -->
            <div class="md:w-1/2 flex flex-col items-center">
                @if ($product->is_featured)
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
                <p class="text-lg font-bold mb-4">
                    <span class="{{ $product->in_stock ? 'text-green-600' : 'text-green-600' }}">
                        {{-- {{ $product->in_stock ? 'IN STOCK' : 'OUT OF STOCK' }} --}}
                        IN STOCK
                    </span>
                </p>

                <!-- Price -->
                <p class="text-3xl font-bold text-gray-900 mb-6">
                    ${{ number_format($product->price, 2) }}
                </p>

                <!-- Quantity Selector -->
                <div class="flex items-center mb-6 space-x-4">
                    <label for="qty" class="text-lg text-gray-700 font-medium">Qty:</label>
                    <input type="number" id="qty"
                        class="w-24 border border-gray-300 rounded-md px-4 py-2 text-lg focus:ring-2 focus:ring-blue-500 transition-all"
                        value="1" min="1">

                    <form action="{{ route('user.cart.add', $product->id) }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="py-[10px] px-[20px] bg-blue-500 text-white font-bold rounded-[24px] border-2 border-blue-500 hover:bg-[#ffffff] hover:text-blue-700 transition">
                            Add to Basket
                        </button>
                    </form>
                </div>

                <!-- Action Buttons (Add to Favorites / Add to Compare) -->
                <div class="flex space-x-6 mt-8">
                    <span
                        class="flex items-center text-blue-500 text-lg font-medium cursor-pointer hover:text-blue-700 transition">
                        <i class="ri-heart-line text-xl mr-2"></i> Add to Favourites
                    </span>
                    <span
                        class="flex items-center text-green-700 text-lg font-medium cursor-pointer hover:text-green-500 transition">
                        <i class="ri-arrow-left-right-fill text-xl mr-2"></i> Add to Compare
                    </span>
                </div>
            </div>
        </div>

        <div class="container mx-auto p-4">
            <!-- Tabs Section -->
            <div class="border-gray-300 pb-4">
                <ul class="flex space-x-6 justify-center md:justify-start border-b-2">
                    <!-- Description Tab -->
                    <li class="pb-2 text-xl font-semibold text-gray-600 cursor-pointer" id="description-tab">
                        <a href="javascript:void(0)" class="hover:text-blue-700 transition duration-300">Description</a>
                    </li>

                    <!-- Reviews Tab with Dynamic Review Count -->
                    <li class="pb-2 text-xl font-semibold text-gray-600 cursor-pointer" id="reviews-tab">
                        <a href="javascript:void(0)" class="hover:text-blue-700 transition duration-300">
                            Reviews
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Content Section -->
            <div class="flex flex-col md:flex-row mt-6 space-y-4 md:space-y-0 md:space-x-8">
                <!-- Left Section: Description -->
                <div class="md:w-2/3 bg-white p-6 rounded-lg" id="description-section">
                    <h2 class="text-2xl font-semibold text-gray-800">{{ $product->name }}</h2>
                    <p class="text-gray-700 mt-4">
                        {!! $product->description !!}
                    </p>
                </div>

                <!-- Right Section: Specifications -->
                <div class="md:w-1/3 bg-white p-6 rounded-lg" id="specifications-section">
                    <h3 class="text-xl font-semibold mb-4 text-gray-800">Specifications</h3>
                    <ul>
                        <li class="text-gray-700 mb-2">
                            <span class="font-medium">Brand:</span>
                            <span class="font-semibold text-gray-900 ml-4">
                                {{ $product->brand ? $product->brand->name : 'No Brand' }}
                            </span>
                        </li>
                        <!-- Add more specifications here as needed -->
                    </ul>
                </div>

            </div>


            <!-- Reviews Section -->
            <div id="reviews-section" class="w-full flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-8 mt-0">
                @include('review.index')
            </div>

        </div>
    </div>

    <script>
        // Get the elements for the tabs and content sections
        const descriptionTab = document.getElementById('description-tab');
        const reviewsTab = document.getElementById('reviews-tab');

        const descriptionSection = document.getElementById('description-section');
        const reviewsSection = document.getElementById('reviews-section');
        const specificationsSection = document.getElementById('specifications-section'); // Added specifications section

        // Helper function to toggle tabs and sections
        function setActiveTab(activeTab, activeSection) {
            // Hide all sections
            descriptionSection.classList.add('hidden');
            reviewsSection.classList.add('hidden');

            // Remove active styling from all tabs
            descriptionTab.classList.remove('border-b-2', 'border-blue-500', 'text-blue-600');
            reviewsTab.classList.remove('border-b-2', 'border-blue-500', 'text-blue-600');
            descriptionTab.classList.add('text-gray-600');
            reviewsTab.classList.add('text-gray-600');

            // Show the selected section
            activeSection.classList.remove('hidden');

            // Set the active tab styling
            activeTab.classList.add('border-b-2', 'border-blue-500', 'text-blue-600');

            // Only show specifications when Description is active
            if (activeTab === descriptionTab) {
                specificationsSection.classList.remove('hidden');
            } else {
                specificationsSection.classList.add('hidden');
            }
        }

        // Add event listeners for each tab
        descriptionTab.addEventListener('click', function() {
            setActiveTab(descriptionTab, descriptionSection);
        });

        reviewsTab.addEventListener('click', function() {
            setActiveTab(reviewsTab, reviewsSection);
        });


        // Set the default active tab (Description)
        setActiveTab(descriptionTab, descriptionSection);
    </script>
@endsection
