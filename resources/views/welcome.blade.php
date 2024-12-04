@extends('layouts.master')
@section('content')
    <!--Top image-->
    <div class="w-full">
        <img src="images/top.jpg" alt="Top Banner" class="w-full h-auto">
    </div>

    <div class="bg-[#00718f] text-white text-center py-4">
        <p class="text-lg font-medium">
            Already have an account? <a href="#" class="underline hover:text-gray-200">Sign in here</a>
        </p>
    </div>

    <!--What we do vanney kura-->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 py-8 px-6 md:px-16 text-center">
        <div>
            <div class="flex justify-center mb-4">
                <img src="images/delivery.png" alt="Icon" class="w-16 h-16">
            </div>
            <h3 class="font-sm text-gray-800">Free Delivery Over $50</h3>
        </div>

        <div>
            <div class="flex justify-center mb-4">
                <img src="images/team.png" alt="Icon" class="w-16 h-16">
            </div>
            <h3 class="font-sm text-pink-600">Read our social <br>enterprise story</h3>
        </div>

        <div>
            <div class="flex justify-center mb-4">
                <img src="images/charity.png" alt="Icon" class="w-16 h-16">
            </div>
            <h3 class="font-sm text-gray-800">Registered NDIS <br>Service Provider</h3>
        </div>
    </div>

    <!--Banner image-->
    <div class="w-full px-4">
        <img src="images/banner.jpg" alt="Banner" class="w-full h-auto">
    </div>

    <h1 class="text-3xl md:text-4xl font-extrabold text-[#00718f] mb-2 mt-6 px-4">
        Shop our featured products selection
    </h1>
    <div class="h-1.5 w-20 bg-pink-600 ml-4 mb-4"></div>
    <div class="max-w-7xl mx-auto p-6 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        <!-- Product Card -->
        <div class="bg-white border rounded-lg p-4 relative shadow hover:shadow-lg transition">
            <div class="absolute top-2 left-2 bg-orange-500 text-white text-xs font-bold px-2 py-1 rounded">Featured</div>
            <div class="h-48 flex items-center justify-center bg-gray-100 rounded-lg mb-4 overflow-hidden">
                <img src="images/ww.png" alt="Product Image" class="object-cover w-full h-full">
            </div>
            <h3 class="text-lg justify-center font-semibold text-gray-800">Tena Wet Wipes <br>Plastic Free</h3>
            <p class="text-sm text-gray-600">PKT 48 Units</p>
            <div class="flex items-center gap-1 text-yellow-500 text-sm my-2">
                <span>⭐⭐⭐⭐⭐</span>
                <span class="text-gray-600">(5 Reviews)</span>
            </div>
            <p class="text-lg font-bold text-gray-900">$8.80</p>
            <button class="mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Add to
                Basket</button>
        </div>
        <!-- Product Card 2 -->
        <div class="bg-white border rounded-lg p-4 relative shadow hover:shadow-lg transition">
            <div class="absolute top-2 left-2 bg-orange-500 text-white text-xs font-bold px-2 py-1 rounded">Featured</div>
            <div class="h-48 flex items-center justify-center bg-gray-100 rounded-lg mb-4 overflow-hidden">
                <img src="images/wc.png" alt="Product Image" class="object-cover w-full h-full">
            </div>
            <h3 class="text-lg font-semibold text-gray-800">Tena Wash Cream <br>500ml Pump Bottle</h3>
            <p class="text-sm text-gray-600">EA 1 Unit</p>
            <div class="flex items-center gap-1 text-yellow-500 text-sm my-2">
                <span>⭐⭐⭐⭐⭐</span>
                <span class="text-gray-600">(5 Reviews)</span>
            </div>
            <p class="text-lg font-bold text-gray-900">$8.80</p>
            <button class="mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Add to
                Basket</button>
        </div>
        <!-- Product Card 3 -->
        <div class="bg-white border rounded-lg p-4 relative shadow hover:shadow-lg transition">
            <div class="absolute top-2 left-2 bg-orange-500 text-white text-xs font-bold px-2 py-1 rounded">Featured</div>
            <div class="h-48 flex items-center justify-center bg-gray-100 rounded-lg mb-4 overflow-hidden">
                <img src="images/sw.jpg" alt="Product Image" class="object-cover w-full h-full">
            </div>
            <h3 class="text-lg justify-center font-semibold text-gray-800">Tena Soft Wipes <br>19 X30 Cm</h3>
            <p class="text-sm text-gray-600">BOX 135 Units</p>
            <div class="flex items-center gap-1 text-yellow-500 text-sm my-2">
                <span>⭐⭐⭐⭐⭐</span>
                <span class="text-gray-600">(5 Reviews)</span>
            </div>
            <p class="text-lg font-bold text-gray-900">$17.93</p>
            <button class="mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Add to
                Basket</button>
        </div>
        <!-- Product Card 4 -->
        <div class="bg-white border rounded-lg p-4 relative shadow hover:shadow-lg transition">
            <div class="absolute top-2 left-2 bg-orange-500 text-white text-xs font-bold px-2 py-1 rounded">Featured</div>
            <div class="h-48 flex items-center justify-center bg-gray-100 rounded-lg mb-4 overflow-hidden">
                <img src="images/ss.png" alt="Product Image" class="object-cover w-full h-full">
            </div>
            <h3 class="text-lg justify-center font-semibold text-gray-800">Tena Shampoo And <br>Shower 500ml</h3>
            <p class="text-sm text-gray-600">EA 1 Unit</p>
            <div class="flex items-center gap-1 text-yellow-500 text-sm my-2">
                <span>⭐⭐⭐⭐⭐</span>
                <span class="text-gray-600">(5 Reviews)</span>
            </div>
            <p class="text-lg font-bold text-gray-900">$15.53</p>
            <button class="mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Add to
                Basket</button>
        </div>
    </div>

        <!--Arko Banner image-->
        <div class="w-full px-4">
            <img src="images/banner1.jpg" alt="Banner" class="w-full h-auto">
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center py-8 px-6 md:px-16 bg-white">
            <!-- Video Section -->
            <div class="flex justify-center">
                <iframe class="w-full max-w-md h-60 md:h-64 lg:h-80 shadow-lg"
                    src="https://www.youtube.com/embed/WO2b03Zdu4Q" title="Independence Australia - Your Way"
                    frameborder="0" allow="accelerometer; autoplay; encrypted-media; picture-in-picture" allowfullscreen>
                </iframe>
            </div>

            <div>
                <h1 class="text-3xl md:text-4xl font-extrabold text-[#00718f] mb-4">
                    Welcome to <br>Independence Australia
                </h1>
                <div class="h-1 w-16 bg-pink-500 mb-4"></div>
                <p class="text-gray-700 text-lg leading-relaxed mb-6">
                    Independence Australia is a social enterprise that provides choices for people living with a disability
                    or
                    other personal need, enabling them to regain and retain their independence within an inclusive
                    community.
                </p>
                <a href="#"
                    class="inline-block bg-white border-2 border-[#00718f] text-[#00718f] font-lg font-bold px-6 py-3 rounded-[24px] hover:bg-[#00718f] hover:text-white transition-colors">
                    Our Story
                </a>
            </div>
        </div>
    @endsection
