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

<body class="font-sans bg-white">
    <!-- Header Section -->
    <header class="bg-white shadow-sm fixed w-full top-0 z-50 sm:relative">
        <div class="bg-gray-100 container mx-auto flex justify-between sm:justify-end py-2 px-6 text-sm space-x-8">
            <a href="#" class="text-gray-700 hover:underline">Quick Order</a>
            <a href="#" class="text-gray-700 hover:underline">Our Story</a>
            <a href="#" class="text-gray-700 hover:underline">Contact Us</a>
        </div>
        <div class="container mx-auto flex items-center justify-between py-8 px-6">
            <!-- Mobile Menu Toggle -->
            <div class="md:hidden flex items-center justify-between pr-3">
                <button id="menuToggle" class="text-black">
                    <i class="ri-menu-3-line text-2xl text-[#00718f]"></i>
                </button>
            </div>
            <a href="{{ auth()->check() ? route('user.welcome') : '/' }}" class="flex items-center space-x-4">
                <img src="{{ asset('images/logo.png') }}" alt="Alwayson Medical Logo" class="h-10">
            </a>
            
            <div class="relative flex-1 max-w-md">
                <input type="text" placeholder="What are you looking for?"
                    class="w-full py-2 pl-4 pr-12 border border-gray-300 rounded-lg focus:outline-none sm:block hidden">
                <i class="ri-search-line absolute right-4 top-1/2 transform -translate-y-1/2 text-[#00718f] sm:block"></i>
            </div>
            <div class="flex items-center font-semibold space-x-2">
                <!-- Profile Icon or Login/Signup -->
                @auth <!-- If the user is authenticated -->
                    <div class="w-8 h-8 flex items-center justify-center">
                        <i class="ri-user-3-fill text-[#00718f] text-[25px]"></i>
                    </div>
    
                    <!-- User Information -->
                    <a href="{{ route('user.welcome') }}">
                        <div class="flex flex-col">
                            <p class="font-bold text-gray-800">{{ Auth::user()->name }} {{ Auth::user()->last_name }}</p>
                            <p class="text-sm text-gray-500">B2B Customer</p>
                        </div>
                    </a>
    
                    <!-- Logout Button -->
                    <div class="flex items-center space-x-2 ml-3 border-l-2 pl-3">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-red-500 font-medium hover:underline">
                                Logout
                            </button>
                        </form>
                    </div>
                @else <!-- If the user is not authenticated -->
                    <a href="/login" class="text-gray-900 hover:underline hidden sm:block">
                        <i class="ri-user-3-fill text-[#00718f] text-[20px]"></i> <span>Sign In</span>
                    </a>
                    <span class="hidden sm:block px-0">/</span>
                    <a href="/register" class="text-gray-900 hover:underline hidden sm:block">Register</a>
                @endauth
            </div>
    
            <div class="flex items-center space-x-2 mr-10">
                <div class="relative">
                    <!-- Cart Icon -->
                    <a href="{{ route('user.cart.index') }}" class="text-gray-900 hidden sm:block">
                        <i class="ri-shopping-basket-fill text-[#00718f] font-light text-[25px]"></i>
                        <span>Basket</span>
                    </a>
                
                    <!-- Cart Count -->
                    @if(session('cart_count') > 0)
                        <span class="absolute top-0 right-0 bg-red-500 text-white text-xs rounded-full px-2 py-1 transform translate-x-1/2 -translate-y-1/2">
                            {{ session('cart_count') }}
                        </span>
                    @endif
                </div>
                
                <!-- Mobile Icons only -->
                <a href="#" class="text-gray-900 sm:hidden">
                    <i class="ri-user-3-fill text-[#00718f] text-[20px]"></i>
                </a>
                <a href="#" class="text-gray-900 sm:hidden">
                    <i class="ri-shopping-basket-fill text-[#00718f] font-light text-[25px]"></i>
                </a>
            </div>
        </div>
    </header>
      
    

    <!-- Mobile Menu (Initially Hidden) -->
    <div id="mobileMenu" class="md:hidden fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 hidden z-40">
        <div class="bg-white p-6 space-y-6">
            <button id="closeMenu" class="text-black text-3xl absolute top-3 right-6">
                <i class="fa fa-times"></i>
            </button>
            <ul class="space-y-4 text-xl">
                <li><a href="#">Continence Aids</a></li>
                <li><a href="#">Daily Living & Mobility Aids</a></li>
                <li><a href="#">Medical Aids</a></li>
                <li><a href="#">Nutrition</a></li>
                <li><a href="#">Skin Care</a></li>
                <li><a href="#">Urology</a></li>
                <li><a href="#">Wound Care</a></li>
                <li><a href="#">Others</a></li>
            </ul>
        </div>
    </div>


    <!-- Navigation Section -->
    <nav class="sticky top-0 z-50">
        <div class="bg-[#7eb6c6] py-2 text-black">
            <section>
                <div class="container mx-auto text-center overflow-hidden relative">
                    <div class="slider-container relative h-8">
                        <!-- Slider Text 1 -->
                        <div
                            class="slider-text absolute inset-0 flex items-center justify-center font-normal transition-all duration-1000 transform translate-x-full opacity-0">
                            <i class="ri-hand-heart-line text-[#00718f] mr-2"></i>
                            Empowering independence through choice.
                        </div>

                        <!-- Slider Text 2 -->
                        <div
                            class="slider-text absolute inset-0 flex items-center justify-center font-normal transition-all duration-1000 transform translate-x-full opacity-0">
                            <i class="ri-user-heart-line text-[#00718f] mr-2"></i>
                            Supporting living with dignity and care.
                        </div>

                        <!-- Slider Text 3 -->
                        <div
                            class="slider-text absolute inset-0 flex items-center justify-center font-normal transition-all duration-1000 transform translate-x-full opacity-0">
                            <i class="ri-lightbulb-line text-[#00718f] mr-2"></i>
                            Innovative solutions for everyday living.
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="m-auto bg-[#ffffff] px-3 2xl:px-0 max-w-[1329px] hidden md:block">
    <div class="h-[65px] relative flex items-center justify-between text-[#00718f]">
        <div class="flex space-x-2 font-bold">
            @foreach($categories as $category)
                <div class="relative">
                    <!-- Category Button -->
                    <button class="px-6 py-2" onclick="toggleDropdown(event, 'dropdown-{{ $category->id }}')">
                        {{ $category->name }}
                    </button>

                    <!-- Full Width Dropdown -->
                    <div id="dropdown-{{ $category->id }}" class="absolute left-0 w-full bg-white text-[#00718f] mt-2 hidden px-6 py-4 max-h-[300px] overflow-y-auto">
                        <!-- Dropdown content that changes based on hovered category -->
                        <div class="flex items-center justify-between">
                            <div class="w-1/2">
                                <ul>
                                    @foreach($category->subcategories as $subcategory)
                                        <li class="py-2">
                                            <a href="" class="text-blue-600 hover:text-blue-800">
                                                {{ $subcategory->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="w-1/2">
                                <p class="text-lg">Explore the {{ $category->name }} section</p>
                            </div>
                        </div>
                        <div class="mt-4">
                            <img class="w-20 h-20 object-contain" src="{{ asset('images/banner.jpg') }}" alt="Category Banner">
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<script>
    // Function to toggle the dropdown visibility on click
    function toggleDropdown(event, dropdownId) {
        // Prevent the page from scrolling when clicking the button
        event.preventDefault();

        // Get the dropdown element by its ID
        const dropdown = document.getElementById(dropdownId);
        
        // Toggle the dropdown visibility
        dropdown.classList.toggle('hidden');
    }

    // Close all dropdowns if the user clicks outside any dropdown
    document.addEventListener('click', function (e) {
        const dropdowns = document.querySelectorAll('.absolute');
        dropdowns.forEach(dropdown => {
            if (!dropdown.contains(e.target) && !e.target.closest('button')) {
                dropdown.classList.add('hidden');
            }
        });
    });
</script>



    </nav>

    <!-- Main Content -->
    @yield('content')

    <!-- Footer Section -->
    <footer class="bg-white py-6">
        <div class="bg-[#7eb6c6] w-full py-12 px-4 lg:px-16">
            <div class="flex flex-col md:flex-row justify-between items-center space-y-6 md:space-y-0 md:space-x-8">
                <!-- Info Section -->
                <div class="text-center md:text-left max-w-xl">
                    <h1 class="text-[#0f6178] text-4xl font-bold mb-4">Newsletter Sign Up</h1>
                    <p class="text-black text-lg leading-relaxed">
                        By providing your email address, you are consenting to receive marketing communications such as
                        promotional offers and newsletters from Alwayson Medical. You can unsubscribe at any time.
                    </p>
                </div>

                <div class="flex w-full sm:w-auto">
                    <input type="email" placeholder="Enter your email"
                        class="px-6 py-3 rounded-l-full border border-gray-300 focus:outline-none w-full sm:w-[400px]">

                    <!-- Subscribe Button -->
                    <button
                        class="bg-[#0f6178] font-semibold text-white px-6 py-3 rounded-r-full hover:bg-white hover:text-[#0f6178] border-2 border-[#0f6178] transition">
                        SUBSCRIBE
                    </button>
                </div>
            </div>
        </div>

        <div class="container mx-auto px-6 py-6 space-y-6">
            <div class="flex flex-col lg:flex-row lg:items-center justify-between text-gray-700 text-sm">
                <p class="text-center lg:text-left">
                    &copy; 2024 Alwayson Medical &nbsp; | &nbsp; All rights reserved.
                </p>
                <div
                    class="flex justify-center lg:justify-end space-x-8 text-[#00718f] text-sm font-extrabold mt-4 lg:mt-0">
                    <a href="#" class="hover:underline">Shop by Brand</a>
                    <a href="#" class="hover:underline">FAQ</a>
                    <a href="#" class="hover:underline">Health Guides</a>
                    <a href="#" class="hover:underline">Terms & Conditions</a>
                </div>
            </div>

            <hr class="border-gray-300">
            <div class="flex flex-col lg:flex-row lg:items-center justify-between">
                <!-- Social Media Icons -->
                <div class="flex justify-center lg:justify-start space-x-4">
                    <a href="#" class="text-[#00718f] hover:opacity-75">
                        <i class="ri-facebook-fill text-[25px] "></i>
                    </a>
                    <a href="#" class="text-[#00718f] hover:opacity-75">
                        <i class="ri-twitter-fill text-[25px]"></i>
                    </a>
                    <a href="#" class="text-[#00718f] hover:opacity-75">
                        <i class="ri-linkedin-box-fill text-[25px]"></i>
                    </a>
                </div>

                <!-- Payment Methods -->
                <div class="flex items-center justify-center lg:justify-end space-x-4 mt-4 lg:mt-0 h-8">
                    <span class="text-gray-700 font-semibold">We accept</span>
                    <i class="ri-visa-fill text-[#00718f]"></i>
                    <i class="ri-mastercard-line text-[#00718f]"></i>
                    <i class="ri-paypal-fill text-[#00718f]"></i>
                </div>
            </div>
        </div>
    </footer>

    <script>
        const sliderTexts = document.querySelectorAll('.slider-text');
        let currentIndexs = 0;

        function showSliderText() {
            sliderTexts.forEach((text, index) => {
                text.classList.remove('translate-x-0', 'translate-x-full', '-translate-x-full', 'opacity-100',
                    'opacity-0');

                if (index === currentIndexs) {
                    // Show the current text
                    text.classList.add('translate-x-0', 'opacity-100');
                } else if (index === (currentIndexs - 1 + sliderTexts.length) % sliderTexts.length) {
                    // Exit the previous text to the left
                    text.classList.add('-translate-x-full', 'opacity-0');
                } else {
                    // Reset for all other texts
                    text.classList.add('translate-x-full', 'opacity-0');
                }
            });

            currentIndexs = (currentIndexs + 1) % sliderTexts.length;
        }

        // Initial display and rotation
        showSliderText();
        setInterval(showSliderText, 4000);
    </script>



<script>
    // Select all the category buttons and their respective dropdowns
    const buttons = document.querySelectorAll('.group button');
    const dropdowns = document.querySelectorAll('.group .absolute');

    buttons.forEach((button, index) => {
        button.addEventListener('mouseenter', () => {
            // Show the corresponding dropdown when hovering over a category button
            dropdowns[index].classList.remove('hidden');
        });

        button.addEventListener('mouseleave', () => {
            // Hide the dropdown when not hovering
            dropdowns[index].classList.add('hidden');
        });
    });
</script>


    <script>
        const menuToggle = document.getElementById("menuToggle");
        const mobileMenu = document.getElementById("mobileMenu");
        const closeMenu = document.getElementById("closeMenu");

        menuToggle.addEventListener("click", () => {
            mobileMenu.classList.toggle("hidden");
        });

        closeMenu.addEventListener("click", () => {
            mobileMenu.classList.add("hidden");
        });
    </script>

<script>
    if (document.getElementById('flash-message')) setTimeout(() => {
        const msg = document.getElementById('flash-message');
        msg.style.opacity = 0;
        msg.style.transition = "opacity 0.5s ease-out";
        setTimeout(() => msg.remove(), 500);
    }, 3000);

    // Function to toggle the visibility of the dropdown
    function toggleDropdown() {
        const dropdown = document.getElementById('user-dropdown');
        dropdown.classList.toggle('hidden'); // Toggle the 'hidden' class to show/hide the dropdown
    }
</script>
</body>

</html>
