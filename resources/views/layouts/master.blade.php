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
    $categories = \App\Models\Category::with('subcategories')->get();
    $sliderTexts = \App\Models\Text::all();
@endphp

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
                        @foreach ($sliderTexts as $sliderText)
                            <div class="slider-text absolute inset-0 flex items-center justify-center font-normal transition-all duration-1000 transform translate-x-full opacity-0">
                                {{ $sliderText->text }}
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        </div>

       

<!-- Dropdown Content (Full Width) -->
<div class="max-w-screen-xl mx-auto px-8 bg-white py-4">
    <div class="flex items-center justify-between">
        <!-- Main Navbar Content -->
        <div class="flex space-x-10  relative w-full">
            @foreach($categories as $category)
                <a href="{{route('menu.index' , ['id' => $category->id])}}"><div class="relative group">
                    <button class="text-sm text-[#00718f] font-bold" data-menu="menu{{ $category->id }}">
                        {{ $category->name }}
                    </button>
                </div></a>
            @endforeach
        </div>
    </div>
</div>

<!-- Dropdown Content (Full Width) -->
<div id="dropdown" class="absolute left-0 w-full bg-white shadow-lg opacity-0 scale-95 transition-all duration-300 ease-in-out hidden top-full z-50">
    <div class="flex space-x-4">
        <!-- Dropdown Menu Content -->
        <div class="space-y-2 text-black px-4 py-2 w-1/2">
            @foreach($categories as $category)
                <div class="menu-content hidden" id="menu{{ $category->id }}">
                    @foreach($category->subcategories as $submenu)
                        <a href="#" class="block py-2 hover:bg-gray-100 group relative"
                           data-item="{{ $submenu->name }}" 
                           data-child-category="{{ json_encode($submenu->child_categories) }}">
                            {{ $submenu->name }}
                        </a>
                    @endforeach
                </div>
            @endforeach
        </div>

        <!-- Paragraph Content on Right -->
        <div id="right-paragraph" class="w-1/2 px-6 py-4 hidden bg-white shadow-md rounded-lg">
            <div id="paragraph-text"></div>
        </div>
    </div>
</div>



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
                <div class="flex justify-center lg:justify-end space-x-8 text-[#00718f] text-sm font-extrabold mt-4 lg:mt-0">
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
        // Function to toggle the dropdown visibility on click
        function toggleDropdown(event, dropdownId) {
            event.preventDefault();
            const dropdown = document.getElementById(dropdownId);
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

        // Mobile Menu toggle
        const menuToggle = document.getElementById("menuToggle");
        const mobileMenu = document.getElementById("mobileMenu");
        const closeMenu = document.getElementById("closeMenu");

        menuToggle.addEventListener("click", () => {
            mobileMenu.classList.toggle("hidden");
        });

        closeMenu.addEventListener("click", () => {
            mobileMenu.classList.add("hidden");
        });

        // Slider Text
        document.addEventListener('DOMContentLoaded', function () {
            const sliderTexts = document.querySelectorAll('.slider-text');
            let currentIndex = 0;

            function showSliderText() {
                sliderTexts.forEach((text, index) => {
                    text.classList.remove('translate-x-0', 'translate-x-full', '-translate-x-full', 'opacity-100', 'opacity-0');

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

    <script>
  document.addEventListener('DOMContentLoaded', function () {
    const buttons = document.querySelectorAll('[data-menu]');
    const dropdown = document.getElementById('dropdown');
    const menuContents = document.querySelectorAll('.menu-content');
    const rightParagraph = document.getElementById('right-paragraph');
    const paragraphText = document.getElementById('paragraph-text');

    // Show dropdown and change content based on hovered menu
    buttons.forEach(button => {
        button.addEventListener('mouseenter', (e) => {
            dropdown.classList.remove('opacity-0', 'scale-95', 'hidden');
            dropdown.classList.add('opacity-100', 'scale-100');

            // Hide all menu content
            menuContents.forEach(content => content.classList.add('hidden'));

            // Show the content for the hovered menu
            const menuId = e.target.getAttribute('data-menu');
            const menuContent = document.getElementById(menuId);
            menuContent.classList.remove('hidden');
        });
    });

    // Keep dropdown visible when hovering over it
    dropdown.addEventListener('mouseenter', () => {
        dropdown.classList.remove('opacity-0', 'scale-95', 'hidden');
        dropdown.classList.add('opacity-100', 'scale-100');
    });

    // Hide dropdown when mouse leaves both menu and dropdown
    dropdown.addEventListener('mouseleave', () => {
        dropdown.classList.remove('opacity-100', 'scale-100');
        dropdown.classList.add('opacity-0', 'scale-95', 'hidden');
    });

    // Show submenu on hover of menu items
    const items = document.querySelectorAll('.group');
    items.forEach(item => {
        item.addEventListener('mouseenter', () => {
            const submenu = item.querySelector('.submenu');
            const paragraph = document.getElementById('right-paragraph');
            const itemText = item.getAttribute('data-item');  // Get the item label

            // Find the <a> element and get the child category data
            const anchor = item.querySelector('a');
            if (anchor) {
                const childCategoriesJson = anchor.getAttribute('data-child-category');
                console.log('childCategoriesJson:', childCategoriesJson); // Debugging log

                try {
                    const childCategories = JSON.parse(childCategoriesJson);
                    console.log('Parsed child categories:', childCategories); // Debugging log

                    // Update the paragraph content with child category data dynamically
                    paragraphText.innerHTML = `
                        <h3 class="text-xl font-semibold mb-4">Child Categories:</h3>
                        <ul class="space-y-2">
                            ${childCategories.map(child => `
                                <li>
                                    <a href="#" class="text-blue-500 hover:text-blue-700">${child.name}</a>
                                </li>`).join('')}
                        </ul>
                    `;
                } catch (error) {
                    console.error('Error parsing child categories:', error);
                }
            }

            // Show the paragraph when hovering over submenu
            paragraph.classList.remove('hidden');
        });

        item.addEventListener('mouseleave', () => {
            const submenu = item.querySelector('.submenu');
            const paragraph = document.getElementById('right-paragraph');

            if (submenu) {
                submenu.classList.add('hidden');
            }

            // Hide the paragraph when leaving submenu
            paragraph.classList.add('hidden');
        });
    });
});



    </script>
</body>

</html>
