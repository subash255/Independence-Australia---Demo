<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alwayson Medical</title>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@100;300;400;600;700&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
@php
    // Get categories with subcategories
    $sliderTexts = App\Models\Text::orderBy('priority')->get();
    $categories = App\Models\Category::with('subcategories')->get();

    $user = Auth::user();

    if ($user) {
        $userId = $user->id;
    } else {
        $userId = null;
    }

    $users = App\Models\User::where('role', 'user')->where('vendor_id', $userId)->get();
@endphp


{{-- Flash Message
@if (session('success'))
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
</script> --}}

<body class="font-sans bg-white">
    <!-- Header Section -->
    <header class="bg-white shadow-sm fixed w-full top-0 z-50 sm:relative">
        <div class="container mx-auto flex items-center justify-between py-8 px-6">
            <!-- Mobile Menu Toggle -->
            <div class="lg:hidden flex items-center justify-between pr-3">
                <button id="menuToggle" class="mb-2">
                    <i class="ri-menu-fill font-bold text-2xl text-blue-500"></i>
                </button>
            </div>
            <a href="/" class="flex items-center space-x-4">
                {{-- <img src="{{ asset('images/logo.png') }}" alt="Always There Medical Logo" class="h-10"> --}}
                <h1 class="text-2xl font-bold ">Always There <span class="text-blue-500">Medical</span></h1>
            </a>

            <!-- Search Box - Centered and with more width -->
            <div class="relative flex-1 max-w-lg mx-auto">
                <input type="text" id="search-input" placeholder="What are you looking for?"
                    class="w-full py-2 pl-4 pr-12 border border-gray-300 rounded-lg focus:outline-none sm:block hidden"
                    value="{{ $query ?? '' }}">
                <button type="button" id="search-button"
                    class="sm:block hidden absolute right-4 top-1/2 transform -translate-y-1/2 text-blue-500">
                    <i class="ri-search-line"></i> <!-- Icon for search button -->
                </button>

                <!-- Search Results Dropdown (Only visible when there's a query) -->
                <div id="search-results"
                    class="absolute left-0 right-0 bg-white border border-gray-300 rounded-lg shadow-lg mt-2 w-full min-w-[400px] max-h-[500px] overflow-y-auto z-50 hidden">
                    <!-- The results will be injected here by the JavaScript -->
                </div>
            </div>

            <!-- Desktop User Authentication and Basket Section -->
            <div class="flex items-center space-x-2 ml-auto hidden sm:flex">
                @auth <!-- If the user is authenticated -->
                    <!-- User Icon -->
                    <div class="w-8 h-8 flex items-center justify-center sm:block hidden">
                        <i class="ri-user-3-fill text-blue-500 text-[25px]"></i>
                    </div>

                    <!-- User Information for Desktop -->
                    <div class="hidden sm:flex flex-col">
                        <a href="{{ route('user.welcome') }}">
                            <p class="font-bold text-gray-800">{{ Auth::user()->name }} {{ Auth::user()->last_name }}</p>
                            <p class="text-sm text-gray-500">B2B Customer</p>
                        </a>
                    </div>

                    <!-- Logout Button (For Desktop View) -->
                    <div class="flex items-center space-x-2 ml-3 border-l-2 pl-3 hidden sm:flex">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-red-500 font-medium hover:underline">
                                <i class="ri-logout-circle-r-line text-red-500 text-[20px]"></i>
                                Logout
                            </button>
                        </form>
                    </div>
                @else
                    <!-- If the user is not authenticated, show login and register buttons -->
                    <a href="/login" class="text-gray-900 hover:underline font-bold">
                        <i class="ri-user-3-fill text-blue-500 text-[20px]"></i> <span>Sign In</span>
                    </a>
                    <span class="px-1">/</span>
                    <a href="/register" class="text-gray-900 hover:underline font-bold">Register</a>
                @endauth

                <!-- Cart Icon with count -->
                <div class="relative">
                    <span class="px-2"></span>
                    <a href="{{ route('user.cart.index') }}" class="text-gray-900 font-bold">
                        <i class="ri-shopping-basket-fill text-blue-500 font-light text-[25px]"></i>
                        <span>Basket</span>
                    </a>

                    <!-- Cart Count -->
                    @if (session('cart_count') > 0)
                        <span
                            class="absolute top-0 right-0 bg-red-500 text-white text-xs rounded-full px-2 py-1 transform translate-x-1/2 -translate-y-1/2">
                            {{ session('cart_count') }}
                        </span>
                    @endif
                </div>
            </div>

            <!-- Mobile Icons only -->
            <div class="flex items-center space-x-2 sm:hidden">
                <!-- Search Icon -->
                <a href="#" id="mobile-search-toggle" class="text-gray-900">
                    <i class="ri-search-line text-blue-500 text-[20px]"></i>
                </a>

                @auth <!-- If the user is authenticated -->
                    <!-- Logout Icon for Mobile View -->
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="font-medium hover:underline">
                            <i class="ri-logout-circle-r-line text-red-500 text-[20px]"></i>
                        </button>
                    </form>
                @else
                    <!-- If the user is not authenticated -->
                    <a href="{{ route('login') }}" class="text-gray-900 hover:underline">
                        <i class="ri-user-3-fill text-blue-500 text-[20px]"></i>
                    </a>
                @endauth

                <!-- Cart Icon -->
                <a href="{{ route('user.cart.index') }}" class="text-gray-900">
                    <i class="ri-shopping-basket-fill text-blue-500 font-light text-[25px]"></i>
                </a>
            </div>

           <!-- Mobile Search Box (Initially Hidden) -->
<div id="mobile-search-popup" class="absolute top-0 left-0 right-0 w-full bg-white p-4 z-50 hidden">
    <div class="relative max-w-md mx-auto">
        <input type="text" id="search-input-mobile" placeholder="What are you looking for?"
            class="w-full py-2 pl-4 pr-12 border border-gray-300 rounded-lg focus:outline-none"
            value="{{ $query ?? '' }}">
        
        <!-- Add search button for mobile view -->
        <button type="button" id="search-button-mobile"
            class="absolute right-4 top-1/2 transform -translate-y-1/2 text-blue-500">
            <i class="ri-search-line"></i> <!-- Icon for search button -->
        </button>
    </div>

    <!-- Search Results Dropdown (Only visible when there's a query) -->
    <div id="search-results-mobile"
        class="absolute left-0 right-0 bg-white border border-gray-300 rounded-lg shadow-lg mt-2 w-full min-w-[400px] max-h-[500px] overflow-y-auto z-50 hidden">
        <!-- The results will be injected here by the JavaScript -->
    </div>

    <!-- Close Button to Hide Search Popup -->
    <button id="close-search-popup" class="absolute top-2 right-2 text-gray-500">
        <i class="ri-close-line text-[20px]"></i>
    </button>
</div>

        </div>
    </header>



    <!-- Mobile Menu (Initially Hidden) -->
    <div id="mobileMenu"
        class="lg:hidden fixed top-24 left-[-100%] w-3/4 h-full bg-black bg-opacity-50 transition-all duration-300 ease-in-out z-40">
        <div class="w-full bg-gray-100 p-4 rounded-md shadow-sm h-full flex flex-col">
            <!-- Close Button -->
            <button id="closeMenu" class="text-black text-3xl absolute top-3 right-6 z-50">
                <i class="fa fa-times"></i>
            </button>

            <!-- Scrollable Content Area -->
            <div class="w-full overflow-x-hidden"> <!-- Prevents horizontal overflow -->
                <div class="flex-grow overflow-y-auto">
                    <div class="space-y-4">
                        @foreach ($categories as $category)
                            @if ($category->status == 1)
                                <div>
                                    <!-- Category Button to Toggle Subcategories -->
                                    <a href="{{ route('menu.index', ['id' => $category->id]) }}">
                                        <button
                                            class="w-full text-left font-semibold text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-md px-2 py-2 flex items-center justify-between border-b border-gray-300">
                                            <span class="flex-grow">{{ $category->name }}</span>
                                            <i onclick="showToggle(event, {{ $category->id }})"
                                                class="ri-arrow-down-s-line text-gray-600 cursor-pointer"></i>
                                        </button>
                                    </a>

                                    <!-- Subcategory Dropdown (Hidden by Default) -->
                                    <div id="{{ $category->id }}"
                                        class="hidden space-y-2 ml-4 mt-2 transition-all duration-300 ease-in-out">
                                        @foreach ($category->subcategories as $subcategory)
                                            <div class="flex items-center space-x-2">
                                                <span class="text-gray-600">{{ optional($subcategory)->name }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Navigation Section -->
    <nav class="sticky top-0 z-40 lg:block hidden">
        <div class="bg-blue-500 py-2 text-white">
            <section>
                <div class="container mx-auto text-center overflow-hidden relative">
                    <div class="slider-container relative h-8">
                        @foreach ($sliderTexts as $sliderText)
                            <div
                                class="slider-text absolute inset-0 flex items-center justify-center font-normal transition-all duration-1000 transform translate-x-full opacity-0">
                                {{ $sliderText->text }}
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        </div>


        <div class="max-w-full mx-auto px-5 bg-white py-4">
            <div class="flex items-center justify-between">
                <!-- Main Navbar Content -->
                <div class="flex justify-center space-x-5 relative w-full">
                    @foreach ($categories as $category)
                        @if ($category->status == 1)
                            <a href="{{ route('menu.index', ['id' => $category->id]) }}">
                                <div class="relative group">
                                    <button
                                        class="text-sm text-blue-500 font-bold transition duration-200 ease-in-out hover:text-blue-800">
                                        {{ $category->name }}
                                    </button>

                                    <!-- Dropdown Menu for Each Category -->
                                    <div
                                        class="menu-content absolute left-0 w-56 bg-white shadow-lg rounded-md opacity-0 scale-95 transition-all duration-300 ease-in-out z-50 group-hover:opacity-100 group-hover:scale-100 group-hover:block hidden">
                                        <div class="space-y-2 text-black px-4 py-3">
                                            @foreach ($category->subcategories as $submenu)
                                                <a href="#"
                                                    class="block py-2 px-3 rounded-md text-sm font-medium text-gray-700 hover:bg-blue-500 hover:text-white transition duration-150 ease-in-out"
                                                    data-item="{{ $submenu->name }}"
                                                    data-child-category="{{ json_encode($submenu->child_categories) }}">
                                                    {{ $submenu->name }}
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>


    </nav>
    <div class="main-content pt-20 sm:pt-0">
        <!-- Main Content -->
        @yield('content')
    </div>

    <!-- Footer Section -->
    <footer class="bg-white py-6">
        <div class="bg-blue-500 w-full py-12 px-4 lg:px-16">
            <div class="flex flex-col md:flex-row justify-between items-center space-y-6 md:space-y-0 md:space-x-8">
                <!-- Info Section -->
                <div class="text-center md:text-left max-w-xl">
                    <h1 class="text-white text-4xl font-bold mb-4">Newsletter Sign Up</h1>
                    <p class="text-white text-lg leading-relaxed">
                        By providing your email address, you are consenting to receive marketing communications such as
                        promotional offers and newsletters from Alwayson Medical. You can unsubscribe at any time.
                    </p>
                </div>

                <div class="flex w-full sm:w-auto">
                    <input type="email" placeholder="Enter your email"
                        class="px-6 py-3 rounded-l-full border border-gray-300 focus:outline-none w-full sm:w-[400px]">

                    <!-- Subscribe Button -->
                    <button
                        class="bg-blue-700 font-semibold text-white px-6 py-3 rounded-r-full hover:bg-white hover:text-blue-900 border-2 border-blue-800 transition">
                        SUBSCRIBE
                    </button>
                </div>
            </div>
        </div>

        <div class="container mx-auto px-6 py-6 space-y-6">
            <div
                class="flex justify-center lg:justify-center space-x-8 text-blue-500 text-sm font-extrabold mt-4 flex-wrap">
                <a href="#" class="hover:underline">Our Story</a>
                <a href="#" class="hover:underline">Contact Us</a>
                <a href="#" class="hover:underline">FAQ</a>
                <a href="#" class="hover:underline">Terms & Conditions</a>
            </div>
            <hr class="border-gray-300">
            <div class="flex flex-col lg:flex-row lg:items-center justify-between text-gray-700 text-sm">
                <!-- Social Media Icons -->
                <div class="flex justify-center lg:justify-start space-x-4">
                    <a href="#" class="text-blue-500 hover:opacity-75">
                        <i class="ri-facebook-fill text-[25px] "></i>
                    </a>
                    <a href="#" class="text-blue-500 hover:opacity-75">
                        <i class="ri-twitter-fill text-[25px]"></i>
                    </a>
                    <a href="#" class="text-blue-500 hover:opacity-75">
                        <i class="ri-linkedin-box-fill text-[25px]"></i>
                    </a>
                </div>

                <!-- Payment Methods -->
                <div class="flex items-center justify-center lg:justify-end space-x-4 mt-4 lg:mt-0 h-8">
                    <span class="text-gray-700 font-semibold">We accept</span>
                    <i class="ri-visa-fill text-blue-500"></i>
                    <i class="ri-mastercard-line text-blue-500"></i>
                    <i class="ri-paypal-fill text-blue-500"></i>
                </div>
            </div>


            <hr class="border-gray-300">

            <!-- Copyright Section Centered -->
            <div class="flex justify-center text-gray-700 text-sm">
                <p class="text-center">
                    &copy; 2024 Alwayson Medical &nbsp; | &nbsp; All rights reserved.
                </p>
            </div>

        </div>

    </footer>

    <script>
        const menuToggle = document.getElementById("menuToggle");
        const mobileMenu = document.getElementById("mobileMenu");
        const closeMenu = document.getElementById("closeMenu");

        menuToggle.addEventListener("click", () => {
            mobileMenu.classList.toggle("left-[-100%]"); // Slide in/out
            mobileMenu.classList.toggle("left-0"); // Position at 0 when visible
        });

        closeMenu.addEventListener("click", () => {
            mobileMenu.classList.add("left-[-100%]"); // Slide out to the left
        });

        // Slider Text
        document.addEventListener('DOMContentLoaded', function() {
            const sliderTexts = document.querySelectorAll('.slider-text');
            let currentIndex = 0;

            function showSliderText() {
                sliderTexts.forEach((text, index) => {
                    text.classList.remove('translate-x-0', 'translate-x-full', '-translate-x-full',
                        'opacity-100', 'opacity-0');

                    if (index === currentIndex) {
                        text.classList.add('translate-x-0', 'opacity-100');
                    } else if (index === (currentIndex - 1 + sliderTexts.length) % sliderTexts.length) {
                        text.classList.add('-translate-x-full', 'opacity-0');
                    } else {
                        text.classList.add('translate-x-full', 'opacity-0');
                    }
                });

                currentIndex = (currentIndex + 1) % sliderTexts.length;
            }

            showSliderText();
            setInterval(showSliderText, 4000);
        });
    </script>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Common function to handle search results for both mobile and desktop views
        function handleSearch(query, resultsContainer, inputElement) {
            if (query.length > 0) {
                $.ajax({
                    url: "{{ route('product.index') }}", // The route that handles the search
                    method: 'GET',
                    data: {
                        query: query
                    },
                    success: function(response) {
                        console.log("Search results response:", response); // Log the response to see the data
    
                        if (response && response.products && Array.isArray(response.products)) {
                            var products = response.products;
                            var resultsHtml = '';
    
                            if (products.length > 0) {
                                products.forEach(function(product) {
                                    resultsHtml += `
                                        <div class="search-item py-2 px-4 flex items-center cursor-pointer hover:bg-gray-100" data-id="${product.id}">
                                            <img src="${product.image}" alt="${product.name}" class="w-8 h-8 mr-4">
                                            <span class="text-sm font-semibold">${product.name}</span>
                                        </div>
                                    `;
                                });
                            } else {
                                resultsHtml = '<div class="no-results py-2 px-4 text-center text-sm text-gray-500">No products found</div>';
                            }
    
                            $(resultsContainer).html(resultsHtml);
                            $(resultsContainer).removeClass('hidden'); // Show the results container
                        } else {
                            console.error('Invalid response structure:', response);
                            $(resultsContainer).html(
                                '<div class="text-center text-sm text-red-500">Error: No products found or invalid response</div>'
                            );
                            $(resultsContainer).removeClass('hidden');
                        }
                    },
                    error: function() {
                        console.log('Error fetching data');
                        $(resultsContainer).html(
                            '<div class="text-center text-sm text-red-500">Error fetching search results. Please try again.</div>'
                        );
                        $(resultsContainer).removeClass('hidden');
                    }
                });
            } else {
                $(resultsContainer).empty(); // Clear the results if no query
                $(resultsContainer).addClass('hidden'); // Hide the results container
            }
        }
    
        // Handle desktop search input (keyup event)
        document.getElementById('search-input').addEventListener('keyup', function() {
            var query = document.getElementById('search-input').value;
            handleSearch(query, '#search-results', '#search-input');
        });
    
        // Handle click on the search button (desktop)
        document.getElementById('search-button').addEventListener('click', function(e) {
            e.preventDefault();  // Prevent the default form submit (if any)
            var query = document.getElementById('search-input').value;
            
            if (query.length > 0) {
                // Redirect to the product index page with the search query as a parameter
                window.location.href = "{{ route('product.index') }}?query=" + encodeURIComponent(query);
            }
        });
    
        // Handle mobile search input (input event)
        document.getElementById('search-input-mobile').addEventListener('input', function() {
            var query = document.getElementById('search-input-mobile').value.trim();
            handleSearch(query, '#search-results-mobile', '#search-input-mobile');
        });
    
        // Handle mobile search button click
        document.getElementById('search-button-mobile').addEventListener('click', function() {
            var query = document.getElementById('search-input-mobile').value.trim();
            
            if (query.length > 0) {
                // Redirect to the product index page with the search query as a parameter
                window.location.href = "{{ route('product.index') }}?query=" + encodeURIComponent(query);
            }
        });
    
        // Mobile search toggle button
        const mobileSearchToggle = document.getElementById('mobile-search-toggle');
        const mobileSearchPopup = document.getElementById('mobile-search-popup');
        const closeSearchPopup = document.getElementById('close-search-popup');
    
        // Show search box on mobile when search icon is clicked
        mobileSearchToggle.addEventListener('click', function(e) {
            e.preventDefault();
            mobileSearchPopup.classList.remove('hidden');
            document.getElementById('search-input-mobile').focus(); // Focus on input when the search box is opened
        });
    
        // Close the search popup when the close button is clicked
        closeSearchPopup.addEventListener('click', function() {
            mobileSearchPopup.classList.add('hidden');
            document.getElementById('search-results-mobile').classList.add('hidden'); // Hide results when closing the popup
        });
    
        // Handle click on search result item (both for desktop and mobile)
        function handleSearchResultClick(event, inputElement, resultsContainer) {
            var productName = $(event.currentTarget).find('span').text(); // Get the clicked search item text (product name)
            $(inputElement).val(productName); // Update the input field with the selected product's name (only the name, not the image)
            $(resultsContainer).empty();
            $(resultsContainer).addClass('hidden');
        }
    
        // For Desktop Results Click
        $('#search-results').on('click', '.search-item', function(event) {
            handleSearchResultClick(event, '#search-input', '#search-results');
        });
    
        // For Mobile Results Click
        $('#search-results-mobile').on('click', '.search-item', function(event) {
            handleSearchResultClick(event, '#search-input-mobile', '#search-results-mobile');
        });
    </script>
    



    <script>
        // Combined toggle function
        function showToggle(event, id) {
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
        // If needed, add a script to control the visibility dynamically
        document.addEventListener('DOMContentLoaded', () => {
            const categories = document.querySelectorAll('.category-container');
            categories.forEach(category => {
                const status = category.getAttribute('data-status');
                if (status == 0) {
                    category.style.display = 'none'; // Hide inactive categories
                }
            });
        });
    </script>


</body>

</html>
