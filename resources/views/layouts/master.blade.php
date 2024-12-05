<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In - Independence Australia</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@100;300;400;600;700&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">

    <style>
        @layer utilities {
            @keyframes slideText {
                0% {
                    transform: translateX(100%);
                }

                100% {
                    transform: translateX(-100%);
                }
            }

            .animate-slide-text {
                animation: slideText 15s linear infinite;
            }
        }
    </style>
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
                <a href="/signin" class="text-gray-900 hover:underline hidden sm:block">
                    <i class="fa fa-user text-[#00718f]"></i> <span>Sign In</span>
                </a>
                <span class="hidden sm:block">/</span>
                <a href="/create" class="text-gray-900 hover:underline hidden sm:block pr-12">Register</a>
                <a href="#" class="text-gray-900 hidden sm:block">
                    <i class="fa fa-shopping-cart text-[#00718f]"></i> <span>Basket</span>
                </a>
                <!-- Mobile Icons only -->
                <a href="#" class="text-gray-900 sm:hidden">
                    <i class="fa fa-user text-[#00718f]"></i>
                </a>
                <a href="#" class="text-gray-900 sm:hidden">
                    <i class="fa fa-shopping-cart text-[#00718f]"></i>
                </a>
            </div>
        </div>
    </header>

    <!-- Navigation Section -->
    <nav class="sticky top-0 z-50">
        <div class="bg-[#7eb6c6] py-2 text-black overflow-hidden">
            <div class="animate-slide-text container mx-auto flex whitespace-nowrap">
                <span class="text-lg mr-10">Welcome to Independence Australia! Explore our wide range of
                    products.</span>
                <span class="text-lg mr-10">Check out our latest arrivals and exclusive offers.</span>
                <span class="text-lg mr-10">Join our community and enjoy benefits like faster checkout and
                    tracking.</span>
            </div>
        </div>
        <div class="bg-white container mx-auto flex justify-center space-x-10 py-2 font-bold text-lg relative">
            <!-- Desktop Navigation Links -->
            <div class="hidden md:flex space-x-10">
                <div class="group relative">
                    <a href="#" class="text-[#00718f] hover:underline">Continence Aids</a>
                    <div class="absolute hidden group-hover:block bg-white shadow-lg w-48 p-4">
                        <p>Details about Continence Aids...</p>
                    </div>
                </div>
                <div class="group relative">
                    <a href="#" class="text-[#00718f] hover:underline">Daily Living & Mobility Aids</a>
                    <div class="absolute hidden group-hover:block bg-white shadow-lg w-48 p-4">
                        <p>Details about Daily Living & Mobility Aids...</p>
                    </div>
                </div>
                <div class="group relative">
                    <a href="#" class="text-[#00718f] hover:underline">Medical Aids</a>
                    <div class="absolute hidden group-hover:block bg-white shadow-lg w-48 p-4">
                        <p>Details about Medical Aids...</p>
                    </div>
                </div>
                <div class="group relative">
                    <a href="#" class="text-[#00718f] hover:underline">Nutrition</a>
                    <div class="absolute hidden group-hover:block bg-white shadow-lg w-48 p-4">
                        <p>Details about Nutrition...</p>
                    </div>
                </div>
                <div class="group relative">
                    <a href="#" class="text-[#00718f] hover:underline">Skin Care</a>
                    <div class="absolute hidden group-hover:block bg-white shadow-lg w-48 p-4">
                        <p>Details about Skin Care...</p>
                    </div>
                </div>
                <div class="group relative">
                    <a href="#" class="text-[#00718f] hover:underline">Urology</a>
                    <div class="absolute hidden group-hover:block bg-white shadow-lg w-48 p-4">
                        <p>Details about Urology...</p>
                    </div>
                </div>
                <div class="group relative">
                    <a href="#" class="text-[#00718f] hover:underline">Wound Care</a>
                    <div class="absolute hidden group-hover:block bg-white shadow-lg w-48 p-4">
                        <p>Details about Wound Care...</p>
                    </div>
                </div>
                <div class="group relative">
                    <a href="#" class="text-[#00718f] hover:underline">Others</a>
                    <div class="absolute hidden group-hover:block bg-white shadow-lg w-48 p-4">
                        <p>Details about Others...</p>
                    </div>
                </div>
            </div>

            <!-- Mobile Menu Links -->
            <ul id="mobileMenu" class="absolute bg-white w-full hidden py-2 px-6 text-lg top-[100%] left-0 shadow-md">
                <li><a href="#" class="text-[#00718f] hover:underline py-2 block">Continence Aids</a></li>
                <li><a href="#" class="text-[#00718f] hover:underline py-2 block">Daily Living & Mobility Aids</a>
                </li>
                <li><a href="#" class="text-[#00718f] hover:underline py-2 block">Medical Aids</a></li>
                <li><a href="#" class="text-[#00718f] hover:underline py-2 block">Nutrition</a></li>
                <li><a href="#" class="text-[#00718f] hover:underline py-2 block">Skin Care</a></li>
                <li><a href="#" class="text-[#00718f] hover:underline py-2 block">Urology</a></li>
                <li><a href="#" class="text-[#00718f] hover:underline py-2 block">Wound Care</a></li>
                <li><a href="#" class="text-[#00718f] hover:underline py-2 block">Others</a></li>
            </ul>
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
                        By providing your email address, you are consenting to receive marketing communications such as promotional offers and newsletters from Independence Australia. You can unsubscribe at any time.
                    </p>
                </div>
                <!-- Subscription Form -->
                <div class="flex flex-col sm:flex-row items-center w-full md:w-auto">
                    <input type="email" placeholder="Enter your email" class="flex-grow sm:flex-grow-0 px-40 py-3 rounded-l-full border border-gray-300 focus:outline-none w-full sm:w-auto">
                    <button class="bg-[#0f6178] font-semibold text-white px-6 py-3 rounded-r-full hover:bg-white hover:text-[#0f6178] border-2 border-[#0f6178] transition">
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
                        <i class="fab fa-facebook-f text-xl"></i>
                    </a>
                    <a href="#" class="text-[#00718f] hover:opacity-75">
                        <i class="fab fa-twitter text-xl"></i>
                    </a>
                    <a href="#" class="text-[#00718f] hover:opacity-75">
                        <i class="fab fa-linkedin-in text-xl"></i>
                    </a>
                </div>

                <!-- Payment Methods -->
                <div class="flex items-center justify-center lg:justify-end space-x-4 mt-4 lg:mt-0">
                    <span class="text-gray-700 font-semibold">We accept</span>
                    <img src="images/visa.png" alt="Visa" class="h-6">
                    <img src="images/mastercard.png" alt="MasterCard" class="h-6">
                    <img src="images/paypal.png" alt="PayPal" class="h-6">
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
    </script>

</body>

</html>
