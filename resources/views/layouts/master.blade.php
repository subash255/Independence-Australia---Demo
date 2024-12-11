<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In - Independence Australia</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@100;300;400;600;700&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">

</head>

<body class="font-sans bg-white">
    <!-- Header Section -->
    <header class="bg-white shadow-sm fixed w-full top-0 z-50 sm:relative">
        <div class="bg-gray-100 container mx-auto flex justify-end py-2 px-6 text-sm space-x-8">
            <a href="#" class="text-gray-700 hover:underline">Quick Order</a>
            <a href="#" class="text-gray-700 hover:underline">Our Story</a>
            <a href="#" class="text-gray-700 hover:underline">Contact Us</a>
        </div>
        <div class="container mx-auto flex items-center justify-between py-8 px-6">
            <!-- Mobile Menu Toggle -->
            <div class="md:hidden flex items-center justify-between pr-3">
                <button id="menuToggle" class="text-black">
                    <i class="fa fa-bars text-2xl"></i>
                </button>
            </div>
            <a href="/" class="flex items-center space-x-4">
                <img src="images/logo.png" alt="Independence Australia Logo" class="h-10">
            </a>
            <div class="relative flex-1 max-w-md">
                <input type="text" placeholder="What are you looking for?"
                    class="w-full py-2 pl-4 pr-12 border border-gray-300 rounded-lg focus:outline-none hidden sm:block">
                <i class="fa fa-search absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-500 sm:block"></i>
            </div>
            <div class="flex items-center font-semibold space-x-3">
                <a href="/login" class="text-gray-900 hover:underline hidden sm:block">
                    <i class="ri-user-3-fill text-[#00718f] text-[20px]"></i> <span>Sign In</span>
                </a>
                <span class="hidden sm:block px-0">/</span>
                <a href="/register" class="text-gray-900 hover:underline hidden sm:block pr-12">Register</a>
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
        <div class="m-auto bg-[#ffffff] px-3 2xl:px-0 max-w-full">
            <div class="h-[65px] relative 1300:h-[60px] flex items-center justify-between text-[#00718f]">
                
                <!-- Continence Aids Dropdown -->
                <div class="relative group">
                    <button class="flex items-center gap-2 font-semibold px-[18px] text-base transition duration-500 ease-in-out cursor-pointer hover:bg-dark-red">
                        <a href="#">Continence Aids</a>
                    </button>
                    <!-- Main Dropdown -->
                    <div class="absolute left-0 mt-2 hidden bg-white shadow-lg rounded-md group-hover:block hover:block z-50 top-full w-full max-w-full">
                        <div class="flex flex-col px-4 py-2">
                            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-teal-100 hover:text-teal-600">Bedding, Chair & Floor Protection</a>
                            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-teal-100 hover:text-teal-600">Bowel Care</a>
                            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-teal-100 hover:text-teal-600">Children's Nappies & Accessories</a>
                            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-teal-100 hover:text-teal-600">Disposable Pads, Pants & Liners</a>
                        </div>
                    </div>
                </div>
        
                <!-- Daily Living & Mobility Aids Dropdown -->
                <div class="relative group">
                    <button class="flex items-center gap-2 font-semibold px-[18px] text-base transition duration-500 ease-in-out cursor-pointer hover:bg-dark-red">
                        <a href="#">Daily Living & Mobility Aids</a>
                    </button>
                    <!-- Main Dropdown -->
                    <div class="absolute left-0 mt-2 hidden bg-white shadow-lg rounded-md group-hover:block hover:block z-50 top-full w-full max-w-full">
                        <div class="flex flex-col px-4 py-2">
                            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-teal-100 hover:text-teal-600">Walking Aids</a>
                            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-teal-100 hover:text-teal-600">Wheelchairs</a>
                            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-teal-100 hover:text-teal-600">Dressing Aids</a>
                        </div>
                    </div>
                </div>
        
                <!-- Medical Aids Dropdown -->
                <div class="relative group">
                    <button class="flex items-center gap-2 font-semibold px-[18px] text-base transition duration-500 ease-in-out cursor-pointer hover:bg-dark-red">
                        <a href="#">Medical Aids</a>
                    </button>
                    <!-- Main Dropdown -->
                    <div class="absolute left-0 mt-2 hidden bg-white shadow-lg rounded-md group-hover:block hover:block z-50 top-full w-full max-w-full">
                        <div class="flex flex-col px-4 py-2">
                            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-teal-100 hover:text-teal-600">Orthopedic Supports</a>
                            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-teal-100 hover:text-teal-600">First Aid Supplies</a>
                        </div>
                    </div>
                </div>
        
                <!-- Nutrition Dropdown -->
                <div class="relative group">
                    <button class="flex items-center gap-2 font-semibold px-[18px] text-base transition duration-500 ease-in-out cursor-pointer hover:bg-dark-red">
                        <a href="#">Nutrition</a>
                    </button>
                    <!-- Main Dropdown -->
                    <div class="absolute left-0 mt-2 hidden bg-white shadow-lg rounded-md group-hover:block hover:block z-50 top-full w-full max-w-full">
                        <div class="flex flex-col px-4 py-2">
                            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-teal-100 hover:text-teal-600">Nutrition Supplements</a>
                            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-teal-100 hover:text-teal-600">Vitamins & Minerals</a>
                        </div>
                    </div>
                </div>
        
                <!-- Skin Care Dropdown -->
                <div class="relative group">
                    <button class="flex items-center gap-2 font-semibold px-[18px] text-base transition duration-500 ease-in-out cursor-pointer hover:bg-dark-red">
                        <a href="#">Skin Care</a>
                    </button>
                    <!-- Main Dropdown -->
                    <div class="absolute left-0 mt-2 hidden bg-white shadow-lg rounded-md group-hover:block hover:block z-50 top-full w-full max-w-full">
                        <div class="flex flex-col px-4 py-2">
                            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-teal-100 hover:text-teal-600">Moisturizers</a>
                            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-teal-100 hover:text-teal-600">Cleansers</a>
                        </div>
                    </div>
                </div>
        
                <!-- Urology Dropdown -->
                <div class="relative group">
                    <button class="flex items-center gap-2 font-semibold px-[18px] text-base transition duration-500 ease-in-out cursor-pointer hover:bg-dark-red">
                        <a href="#">Urology</a>
                    </button>
                    <!-- Main Dropdown -->
                    <div class="absolute left-0 mt-2 hidden bg-white shadow-lg rounded-md group-hover:block hover:block z-50 top-full w-full max-w-full">
                        <div class="flex flex-col px-4 py-2">
                            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-teal-100 hover:text-teal-600">Catheters</a>
                            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-teal-100 hover:text-teal-600">Incontinence Care</a>
                        </div>
                    </div>
                </div>
        
                <!-- Wound Care Dropdown -->
                <div class="relative group">
                    <button class="flex items-center gap-2 font-semibold px-[18px] text-base transition duration-500 ease-in-out cursor-pointer hover:bg-dark-red">
                        <a href="#">Wound Care</a>
                    </button>
                    <!-- Main Dropdown -->
                    <div class="absolute left-0 mt-2 hidden bg-white shadow-lg rounded-md group-hover:block hover:block z-50 top-full w-full max-w-full">
                        <div class="flex flex-col px-4 py-2">
                            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-teal-100 hover:text-teal-600">Bandages</a>
                            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-teal-100 hover:text-teal-600">Dressings</a>
                        </div>
                    </div>
                </div>
        
                <!-- Others Dropdown -->
                <div class="relative group">
                    <button class="flex items-center gap-2 font-semibold px-[18px] text-base transition duration-500 ease-in-out cursor-pointer hover:bg-dark-red">
                        <a href="#">Others</a>
                    </button>
                    <!-- Main Dropdown -->
                    <div class="absolute left-0 mt-2 hidden bg-white shadow-lg rounded-md group-hover:block hover:block z-50 top-full w-full max-w-full">
                        <div class="flex flex-col px-4 py-2">
                            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-teal-100 hover:text-teal-600">Accessories</a>
                            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-teal-100 hover:text-teal-600">Miscellaneous</a>
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
        const menuToggle = document.getElementById('menuToggle');
        const mobileMenu = document.getElementById('mobileMenu');

        const toggleMenu = () => {
            mobileMenu.classList.toggle('hidden');
        };

        menuToggle.addEventListener('click', toggleMenu);

        document.addEventListener('click', (event) => {
            if (!mobileMenu.contains(event.target) && !menuToggle.contains(event.target)) {
                mobileMenu.classList.add('hidden');
            }
        });

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

</body>

</html>
