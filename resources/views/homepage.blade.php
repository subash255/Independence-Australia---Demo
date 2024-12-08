@extends('layouts.master')
@section('content')
    <div class="relative flex flex-col md:flex-row-reverse items-center bg-gray-100 p-8 md:p-16 gap-6 md:gap-12">
        <!-- Background Image Section -->
        <div class="absolute inset-0 bg-cover bg-center rounded-md"
            style="background-image: url('{{ asset('images/budi.jpg') }}'); height: 350px;">
            <!-- Optional Gradient Overlay to enhance text visibility -->
            <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent rounded-md"></div>
        </div>

        <!-- Text Section overlaid on the background image -->
        <div
            class="relative z-10 text-center md:text-left w-full md:w-1/2 text-white px-6 bg-white bg-opacity-40 rounded-md">
            <h1 class="text-teal-700 text-3xl md:text-4xl font-bold mb-4 text-shadow-md">
                Welcome to Independence Australia
            </h1>
            <p class="text-sm md:text-base leading-relaxed text-gray-200 mb-6">
                Independence Australia is a social enterprise that provides choices for people living with a disability or
                other personal need, enabling them to regain and retain their independence within an inclusive community.
            </p>
            <!-- Buttons -->
            <div class="space-y-4 md:space-y-0 md:flex md:items-center md:gap-4">
                <button
                    class="bg-teal-700 text-white py-2 px-6 rounded-md shadow-md hover:bg-teal-800 focus:ring-2 focus:ring-teal-400">
                    Sign in
                </button>
                <p class="text-sm text-gray-300">
                    Don't have an account yet? <a href="#" class="text-teal-700 font-medium hover:underline">Register
                        now</a>
                </p>
            </div>
        </div>
    </div>



    <!--Banner images-->
    <div class="w-full px-4 py-12 banner">
        <img src="images/homepage.jpg" alt="Banner"
            class="w-full h-auto transform transition-all duration-300 ease-in-out shadow-lg">
    </div>


    <div class="w-full px-4 py-6">
        <img src="images/banner.jpg" alt="Banner" class="w-full h-auto">
    </div>

    <h1 class="text-3xl md:text-4xl font-bold text-[#00718f] mb-2 mt-6 px-4">
        Shop by Category
    </h1>
    <div class="h-1.5 w-20 bg-pink-600 ml-4 mb-4"></div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 p-6 bg-gray-100">
        <!-- Continence Aids (takes two rows in height) -->
        <div class="relative row-span-2">
            <img src="{{ asset('images/category/1.jpg') }}" alt="Continence Aids"
                class="w-full h-full object-contain transform transition-transform duration-300 hover:scale-105">

        </div>

        <!-- Nutrition -->
        <div class="relative">
            <img src="{{ asset('images/category/4.jpg') }}" alt="Nutrition"
                class="w-full h-full object-contain transform transition-transform duration-300 hover:scale-105">

        </div>

        <!-- Wound Care -->
        <div class="relative">
            <img src="{{ asset('images/category/8.jpg') }}" alt="Wound Care"
                class="w-full h-full object-contain transform transition-transform duration-300 hover:scale-105">

        </div>

        <!-- Skin Care -->
        <div class="relative">
            <img src="{{ asset('images/category/6.jpg') }}" alt="Skin Care"
                class="w-full h-full object-contain transform transition-transform duration-300 hover:scale-105">

        </div>

        <!-- Medical Aids -->
        <div class="relative">
            <img src="{{ asset('images/category/3.jpg') }}" alt="Medical Aids"
                class="w-full h-full object-contain transform transition-transform duration-300 hover:scale-105">
        </div>

        <!-- Daily Living & Mobility Aids -->
        <div class="relative">
            <img src="{{ asset('images/category/2.jpg') }}" alt="Daily Living & Mobility Aids"
                class="w-full h-full object-contain transform transition-transform duration-300 hover:scale-105">
        </div>

        <!-- Urology -->
        <div class="relative">
            <img src="{{ asset('images/category/7.jpg') }}" alt="Urology"
                class="w-full h-full object-contain transform transition-transform duration-300 hover:scale-105">
        </div>

        <!-- Other -->
        <div class="relative">
            <img src="{{ asset('images/category/5.jpg') }}" alt="Other"
                class="w-full h-full object-contain transform transition-transform duration-300 hover:scale-105">
        </div>
    </div>



    <!--Arko Banner image-->
    <div class="w-full px-4 py-10">
        <img src="images/banner1.jpg" alt="Banner" class="w-full h-auto">
    </div>

    <h1 class="text-3xl md:text-4xl font-bold text-[#00718f] mb-2 mt-6 px-4">
        Shop our featured products selection
    </h1>
    <div class="h-1.5 w-20 bg-pink-600 ml-4 mb-4"></div>
    <div class="max-w-7xl mx-auto p-6 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        <!-- Product Card 1 -->
        <div
            class="bg-white border rounded-lg p-4 relative shadow hover:shadow-lg transition flex flex-col justify-between">
            <div class="absolute top-2 left-2 bg-orange-500 text-white text-xs font-bold px-2 py-1 rounded">Featured</div>
            <div class="h-48 flex items-center justify-center bg-gray-100 rounded-lg mb-4 overflow-hidden">
                <img src="images/ww.png" alt="Product Image" class="object-cover w-full h-full">
            </div>
            <div class="flex flex-col justify-center items-center text-center">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 ">Tena Wet Wipes <br>Plastic Free</h3>
                <p class="text-sm text-gray-900">
                    <span class="font-bold">PKT</span> 48 Units
                </p>
                <div class="flex items-center mb-5 gap-1 text-yellow-500 text-sm my-2 justify-center">
                    <span class="text-pink-500 text-lg">★★★★★</span>
                    <span class="text-gray-600">(5 Reviews)</span>
                </div>
                <p class="text-lg font-semibold text-gray-900">$8.80</p>
                <button
                    class="inline-block bg-white border-2 border-[#00718f] text-[#00718f] font-lg font-bold px-4 py-2 rounded-[24px] hover:bg-[#00718f] hover:text-white transition-colors mt-4">
                    Add to Basket
                </button>
                <span class="text-[#00718f] text-lg pt-4">
                    <i class="ri-heart-line"></i> Add Favourites
                </span>
                <span class="text-green-700 text-lg">
                    <i class="ri-arrow-left-right-fill"></i> Add to Compare
                </span>

            </div>
        </div>

        <!-- Product Card 2 -->
        <div
            class="bg-white border rounded-lg p-4 relative shadow hover:shadow-lg transition flex flex-col justify-between">
            <div class="absolute top-2 left-2 bg-orange-500 text-white text-xs font-bold px-2 py-1 rounded">Featured</div>
            <div class="h-48 flex items-center justify-center bg-gray-100 rounded-lg mb-4 overflow-hidden">
                <img src="images/wc.png" alt="Product Image" class="object-cover w-full h-full">
            </div>
            <div class="flex flex-col justify-center items-center text-center">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Tena Wash Cream <br>500ml Pump Bottle</h3>
                <p class="text-sm text-gray-900">
                    <span class="font-bold">EA</span> 1 Unit
                </p>
                <div class="flex items-center gap-1 text-yellow-500 text-sm my-2 justify-center">
                    <span class="text-pink-500 text-lg">★★★★★</span>
                    <span class="text-gray-600">(5 Reviews)</span>
                </div>
                <p class="text-lg font-semibold text-gray-900">$8.80</p>
                <button
                    class="inline-block bg-white border-2 border-[#00718f] text-[#00718f] font-lg font-bold px-4 py-2 rounded-[24px] hover:bg-[#00718f] hover:text-white transition-colors mt-4">
                    Add to Basket
                </button>
                <span class="text-[#00718f] text-lg pt-4">
                    <i class="ri-heart-line"></i> Add Favourites
                </span>
                <span class="text-green-700 text-lg">
                    <i class="ri-arrow-left-right-fill"></i> Add to Compare
                </span>

            </div>
        </div>

        <!-- Product Card 3 -->
        <div
            class="bg-white border rounded-lg p-4 relative shadow hover:shadow-lg transition flex flex-col justify-between">
            <div class="absolute top-2 left-2 bg-orange-500 text-white text-xs font-bold px-2 py-1 rounded">Featured</div>
            <div class="h-48 flex items-center justify-center bg-gray-100 rounded-lg mb-4 overflow-hidden">
                <img src="images/sw.jpg" alt="Product Image" class="object-cover w-full h-full">
            </div>
            <div class="flex flex-col justify-center items-center text-center">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Tena Soft Wipes <br>19 X30 Cm</h3>
                <p class="text-sm text-gray-900">
                    <span class="font-bold">BOX</span> 135 Units
                </p>
                <div class="flex items-center mb-5 gap-1 text-yellow-500 text-sm my-2 justify-center">
                    <span class="text-pink-500 text-lg">★★★★★</span>
                    <span class="text-gray-600">(5 Reviews)</span>
                </div>
                <p class="text-lg font-semibold text-gray-900">$17.93</p>
                <button
                    class="inline-block bg-white border-2 border-[#00718f] text-[#00718f] font-lg font-bold px-4 py-2 rounded-[24px] hover:bg-[#00718f] hover:text-white transition-colors mt-4">
                    Add to Basket
                </button>
                <span class="text-[#00718f] text-lg pt-4">
                    <i class="ri-heart-line"></i> Add Favourites
                </span>
                <span class="text-green-700 text-lg">
                    <i class="ri-arrow-left-right-fill"></i> Add to Compare
                </span>

            </div>
        </div>

        <!-- Product Card 4 -->
        <div
            class="bg-white border rounded-lg p-4 relative shadow hover:shadow-lg transition flex flex-col justify-between">
            <div class="absolute top-2 left-2 bg-orange-500 text-white text-xs font-bold px-2 py-1 rounded">Featured</div>
            <div class="h-48 flex items-center justify-center bg-gray-100 rounded-lg mb-4 overflow-hidden">
                <img src="images/ss.png" alt="Product Image" class="object-cover w-full h-full">
            </div>
            <div class="flex flex-col justify-center items-center text-center">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Tena Shampoo And <br>Shower 500ml</h3>
                <p class="text-sm text-gray-900">
                    <span class="font-bold">EA</span> 1 Unit
                </p>
                <div class="flex items-center mb-5 gap-1 text-yellow-500 text-sm my-2 justify-center">
                    <span class="text-pink-500 text-lg">★★★★★</span>
                    <span class="text-gray-600">(5 Reviews)</span>
                </div>
                <p class="text-lg font-semibold text-gray-900">$15.53</p>
                <button
                    class="inline-block bg-white border-2 border-[#00718f] text-[#00718f] font-lg font-bold px-4 py-2 rounded-[24px] hover:bg-[#00718f] hover:text-white transition-colors mt-4">
                    Add to Basket
                </button>
                <span class="text-[#00718f] text-lg pt-4">
                    <i class="ri-heart-line"></i> Add Favourites
                </span>
                <span class="text-green-700 text-lg">
                    <i class="ri-arrow-left-right-fill"></i> Add to Compare
                </span>

            </div>
        </div>
    </div>


    <h1 class="text-3xl md:text-4xl font-bold text-[#00718f] mb-2 mt-6 px-4">
        Shop by Brand
    </h1>
    <div class="h-1.5 w-20 bg-pink-600 ml-4 mb-4"></div>

    <div class="w-full bg-white py-6">
        <div class="max-w-6xl mx-auto px-0">
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-5">
                <!-- Brand 1 -->
                <div
                    class="flex justify-center items-center transform transition-transform duration-300 hover:scale-105 hover:shadow-lg hover:shadow-blue-500/50">
                    <img src="images/brands/0.jpg" alt="Brand"
                        class="w-full h-full object-cover transition-all duration-300">
                </div>
                <!-- Brand 2 -->
                <div
                    class="flex justify-center items-center transform transition-transform duration-300 hover:scale-105 hover:shadow-lg hover:shadow-blue-500/50">
                    <img src="images/brands/1.jpg" alt="Brand"
                        class="w-full h-full object-cover transition-all duration-300">
                </div>
                <!-- Brand 3 -->
                <div
                    class="flex justify-center items-center transform transition-transform duration-300 hover:scale-105 hover:shadow-lg hover:shadow-blue-500/50">
                    <img src="images/brands/2.jpg" alt="Brand"
                        class="w-full h-full object-cover transition-all duration-300">
                </div>
                <!-- Brand 4 -->
                <div
                    class="flex justify-center items-center transform transition-transform duration-300 hover:scale-105 hover:shadow-lg hover:shadow-blue-500/50">
                    <img src="images/brands/3.jpg" alt="Brand"
                        class="w-full h-full object-cover transition-all duration-300">
                </div>
                <!-- Brand 5 -->
                <div
                    class="flex justify-center items-center transform transition-transform duration-300 hover:scale-105 hover:shadow-lg hover:shadow-blue-500/50">
                    <img src="images/brands/4.jpg" alt="Brand"
                        class="w-full h-full object-cover transition-all duration-300">
                </div>
                <!-- Brand 6 -->
                <div
                    class="flex justify-center items-center transform transition-transform duration-300 hover:scale-105 hover:shadow-lg hover:shadow-blue-500/50">
                    <img src="images/brands/5.jpg" alt="Brand"
                        class="w-full h-full object-cover transition-all duration-300">
                </div>
                <!-- Brand 7 -->
                <div
                    class="flex justify-center items-center transform transition-transform duration-300 hover:scale-105 hover:shadow-lg hover:shadow-blue-500/50">
                    <img src="images/brands/6.jpg" alt="Brand"
                        class="w-full h-full object-cover transition-all duration-300">
                </div>
                <!-- Brand 8 -->
                <div
                    class="flex justify-center items-center transform transition-transform duration-300 hover:scale-105 hover:shadow-lg hover:shadow-blue-500/50">
                    <img src="images/brands/7.jpg" alt="Brand"
                        class="w-full h-full object-cover transition-all duration-300">
                </div>
                <!-- Brand 9 -->
                <div
                    class="flex justify-center items-center transform transition-transform duration-300 hover:scale-105 hover:shadow-lg hover:shadow-blue-500/50">
                    <img src="images/brands/8.jpg" alt="Brand"
                        class="w-full h-full object-cover transition-all duration-300">
                </div>
                <!-- Brand 10 -->
                <div
                    class="flex justify-center items-center transform transition-transform duration-300 hover:scale-105 hover:shadow-lg hover:shadow-blue-500/50">
                    <img src="images/brands/9.jpg" alt="Brand"
                        class="w-full h-full object-cover transition-all duration-300">
                </div>
            </div>
        </div>

        <!-- View More Button -->
        <div class="flex justify-center mt-8">
            <a href="#"
                class="py-[10px] px-[20px] bg-[#00718f] text-white font-bold rounded-[24px] border-2 border-[#00718f] hover:bg-[#ffffff] hover:text-[#00718f] transition">
                View more brands
            </a>
        </div>
    </div>


    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center py-8 px-6 md:px-16 bg-gray-100">
        <!-- Image Section -->
        <div class="flex justify-center items-center">
            <img class="w-full h-auto shadow-lg rounded-lg" src="images/wheel.jpg" alt="Independence Australia" />
        </div>

        <!-- Text Section -->
        <div>
            <h1 class="text-3xl md:text-4xl font-bold text-[#00718f] ml-4 mb-4">
                Product or Order Inquiry Form
            </h1>
            <p class="text-gray-700 text-lg leading-relaxed mb-6 ml-4">
                You can find the answers to many of our most commonly asked product and order queries online. <br>
                If you are unable to find the answer to your query, please complete our contact form and a member of our
                customer service team will be in touch.
            </p>
            <a href="#"
                class="py-[10px] px-[20px] ml-[150px] bg-[#00718f] text-white font-bold rounded-[24px] border-2 border-[#00718f] hover:bg-[#ffffff] hover:text-[#00718f] transition">
                Fill the enquiry form
            </a>
        </div>
    </div>

    <h1 class="text-3xl md:text-4xl font-bold text-[#00718f] mb-2 mt-6 px-4">
        Explore our pulications
    </h1>
    <div class="h-1.5 w-20 bg-pink-600 ml-4 mb-10"></div>

    <hr class="border-gray-300">
    <div class="w-full bg-white">
        <div class="max-w-3xl mx-auto px-6"> <!-- Added mx-auto for centering and px-6 for equal padding -->
            <p id="text" class="text-black text-lg py-10">
                Independence Australia supplies healthcare and medical supplies to thousands of customers across Australia.
                We stock all major and specialist brands. Key categories include continence, wound care, daily living &
                mobility aids,
                urology, skin care, medical aids & nutrition. <br>
                <span id="more-text" class="hidden">
                    Shop our complete range of products online to receive free shipping over $50, courier tracking and
                    optional discreet packaging.
                    We can make the purchase of your personal and medical supplies easy by providing quick delivery of more
                    than
                    13,000 products directly to your home, anywhere in Australia. <br>
                    Independence Australia also has a unique social enterprise approach that leverages the sale of
                    healthcare products to support
                    our core charitable purpose to provide choices for people living with a disability or other personal
                    need.
                </span>
            </p>

            <button id="toggle-btn" class="text-[#00718f] font-bold hover:underline focus:outline-none">
                More
            </button>
        </div>
    </div>


    <script>
        const toggleBtn = document.getElementById('toggle-btn');
        const moreText = document.getElementById('more-text');
        const text = document.getElementById('text');

        toggleBtn.addEventListener('click', (event) => {
            // Prevent page from scrolling to the button
            event.preventDefault();

            // Toggle the visibility of the additional text
            if (moreText.classList.contains('hidden')) {
                moreText.classList.remove('hidden');
                toggleBtn.textContent = 'Less'; // Change button text to "Less"
            } else {
                moreText.classList.add('hidden');
                toggleBtn.textContent = 'More'; // Change button text back to "More"
            }
        });
    </script>
@endsection
