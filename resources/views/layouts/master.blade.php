<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Independence Australia</title>
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
            <a href="/" class="flex items-center space-x-4">
                <img src="images/logo.png" alt="Independence Australia Logo" class="h-10">
            </a>
            <div class="relative flex-1 max-w-md">
                <input type="text" placeholder="What are you looking for?"
                    class="w-full py-2 pl-4 pr-12 border border-gray-300 rounded-lg focus:outline-none sm:block hidden">
                <i
                    class="ri-search-line absolute right-4 top-1/2 transform -translate-y-1/2 text-[#00718f] sm:block"></i>
            </div>
            <div class="flex items-center font-semibold space-x-3">
                <!-- Check if the user is logged in -->
                @auth
                    <!-- If user is logged in, show their name -->
                    <span class="text-gray-900">Hi, {{ Auth::user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST" class="w-full">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm hover:bg-gray-100">
                            Log Out
                        </button>
                    </form>
                @else
                    <!-- If user is not logged in, show Sign In and Register buttons -->
                    <a href="/login" class="text-gray-900 hover:underline hidden sm:block">
                        <i class="ri-user-3-fill text-[#00718f] text-[20px]"></i> <span>Sign In</span>
                    </a>
                    <span class="hidden sm:block px-0">/</span>
                    <a href="/register" class="text-gray-900 hover:underline hidden sm:block pr-12">Register</a>
                @endauth
                <a href="/checkout" class="text-gray-900 hidden sm:block">
                    <i class="ri-shopping-basket-fill text-[#00718f] font-light text-[25px]"></i> <span>Basket</span>
                </a>
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
                    <!-- Dropdown 1 -->
                    <div class="relative group hidden md:block">
                        <button class="px-6 py-2">Continence Aids</button>
                    </div>

                    <!-- Dropdown 2 -->
                    <div class="relative group hidden md:block">
                        <button class="px-6 py-2">Daily Living & Mobility Aids</button>
                    </div>

                    <!-- Dropdown 3 -->
                    <div class="relative group hidden md:block">
                        <button class="px-6 py-2">Medical Aids</button>
                    </div>

                    <!-- Dropdown 4 -->
                    <div class="relative group hidden md:block">
                        <button class="px-6 py-2">Nutrition</button>
                    </div>

                    <!-- Dropdown 5 -->
                    <div class="relative group hidden md:block">
                        <button class="px-6 py-2">Skin Care</button>
                    </div>

                    <!-- Dropdown 6 -->
                    <div class="relative group hidden md:block">
                        <button class="px-6 py-2">Urology</button>
                    </div>

                    <!-- Dropdown 7 -->
                    <div class="relative group hidden md:block">
                        <button class="px-6 py-2">Wound Care</button>
                    </div>

                    <!-- Dropdown 8 -->
                    <div class="relative group hidden md:block">
                        <button class="px-6 py-2">Others</button>
                    </div>
                </div>

                <!-- Static Dropdown Content -->
                <div id="dropdown-content"
                    class="absolute left-0 w-full bg-white text-[#00718f] mt-[16rem] hidden px-6 py-4 max-h-[300px] overflow-y-auto">
                   <div class="flex items-center justify-between">
                    <div class="flex gap-x-8 font-semibold">
                        <!-- Left side items -->
                        <div class="">
                            <ul id="dropdown-items">
                                <!-- Dynamic items will be inserted here -->
                            </ul>
                        </div>
                        <!-- Right side paragraph -->
                        <div class="">
                            <p id="dropdown-paragraph" class="text-lg">Select a menu to see the content here.</p>
                        </div>
                    </div> 
                    <div>
                        <img class="w-20 h-20 object-contain" src="{{asset('images/banner.jpg')}}" alt="">
                    </div>
                   </div>
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
                        promotional offers and newsletters from Independence Australia. You can unsubscribe at any time.
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
                    &copy; 2024 Hamro Pyaro Australia &nbsp; | &nbsp; All rights reserved.
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
        let currentIndex = 0;
        const slides = document.querySelectorAll("#slider .flex-shrink-0");
        const totalSlides = slides.length;
        const slider = document.getElementById("slider");

        const showSlide = (index) => {
            const offset = -index * 100;
            slider.style.transform = `translateX(${offset}%)`;
        };

        document.getElementById("next").addEventListener("click", () => {
            currentIndex = (currentIndex + 1) % totalSlides;
            showSlide(currentIndex);
        });

        document.getElementById("prev").addEventListener("click", () => {
            currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
            showSlide(currentIndex);
        });

        setInterval(() => {
            currentIndex = (currentIndex + 1) % totalSlides;
            showSlide(currentIndex);
        }, 3000);

        showSlide(currentIndex);
    </script>


    <script>
        const menus = [{
                title: "Continence Aids",
                items: ["Bedding, Chair & Floor Protection", "Bowel Care", "Children's Nappies & Accessories",
                    "Disposable Pads, Pants & Liners"
                ],
                paragraph: "This is the paragraph content for Continence Aids"
            },
            {
                title: "Daily Living & Mobility Aids",
                items: ["Walking Aids", "Clothing & Dressing Aids", "Household Aids", "Household Products"],
                paragraph: "This is the paragraph content for Daily Living & Mobility Aids."
            },
            {
                title: "Medical Aids",
                items: ["Enteral Feeding", "First Aid", "General", "Needles, Syringes & Solutions"],
                paragraph: "This is the paragraph content for Medical Aids."
            },
            {
                title: "Nutrition",
                items: ["Supplements", "Vitamins", "Minerals", "Protein"],
                paragraph: "This is the paragraph content for Nutrition."
            },
            {
                title: "Skin Care",
                items: ["Adhesive & Adhesive Removers", "Serums & Treatments", "Creams, Body Lotions & Oils",
                    "Wipes & Wash Cloths"
                ],
                paragraph: "This is the paragraph content for Skin Care."
            },
            {
                title: "Urology",
                items: ["Catheters", "Condom Drainage", "Drain and Leg Bags", "Urinals & Bed Pans"],
                paragraph: "This is the paragraph content for Urology."
            },
            {
                title: "Wound Care",
                items: ["Bandages", "Burn Treatments", "Scar Management", "Tapes"],
                paragraph: "This is the paragraph content for Wound Care."
            },
            {
                title: "Others",
                items: ["Clothing", "Eye Protection", "Disinfectants & Cleaners", "Personal Gromming & Hygiene"],
                paragraph: "This is the paragraph content for Others."
            }
        ];

        // Get all buttons in the navigation
        const buttons = document.querySelectorAll('.group button');
        const dropdownContent = document.getElementById('dropdown-content');
        const dropdownItems = document.getElementById('dropdown-items');
        const dropdownParagraph = document.getElementById('dropdown-paragraph');

        // Show dropdown when hovering over any menu
        buttons.forEach((button, index) => {
            button.addEventListener('mouseenter', () => {
                // Show the dropdown content once hovering begins
                if (dropdownContent.classList.contains('hidden')) {
                    dropdownContent.classList.remove('hidden');
                }
                // Update dropdown content with corresponding menu data
                updateDropdownContent(menus[index]);
            });
        });

        // Function to update the dropdown content based on the menu selected
        function updateDropdownContent(menu) {
            // Clear previous content
            dropdownItems.innerHTML = '';
            dropdownParagraph.textContent = menu.paragraph;

            // Add new items
            menu.items.forEach(item => {
                const listItem = document.createElement('li');
                listItem.classList.add('py-2');
                listItem.textContent = item;
                dropdownItems.appendChild(listItem);
            });
        }

        // Hide the dropdown when the mouse leaves the navigation or dropdown area
        dropdownContent.addEventListener('mouseleave', () => {
            dropdownContent.classList.add('hidden');
        });

        // Make sure the dropdown stays visible while hovering over it
        dropdownContent.addEventListener('mouseenter', () => {
            dropdownContent.classList.remove('hidden');
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
</body>

</html>
