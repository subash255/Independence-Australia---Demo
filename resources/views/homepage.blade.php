@extends('layouts.master')
@section('content')

<div class="relative w-full overflow-hidden">
    <!-- Slider Wrapper -->
    <div id="slider" class="flex transition-transform duration-700 ease-in-out">
        <!-- First Image -->
        <div class="w-full flex-shrink-0">
            <img src="images/greet.jpg" alt="Image 1" class="w-full h-64 object-cover">
        </div>
        <!-- Second Image -->
        <div class="w-full flex-shrink-0">
            <img src="images/team.jpg" alt="Image 2" class="w-full h-64 object-cover">
        </div>
        <!-- Third Image -->
        <div class="w-full flex-shrink-0">
            <img src="images/resources.jpg" alt="Image 3" class="w-full h-64 object-cover">
        </div>
    </div>

    <!-- Navigation Buttons -->
    <button id="prev"
        class="absolute top-1/2 left-0 transform -translate-y-1/2 bg-gray-800 text-white p-2 rounded-full z-10 md:p-3 md:left-2">
        &#10094;
    </button>
    <button id="next"
        class="absolute top-1/2 right-0 transform -translate-y-1/2 bg-gray-800 text-white p-2 rounded-full z-10 md:p-3 md:right-2">
        &#10095;
    </button>
</div>

    <div class="bg-[#00718f] text-white text-center py-4">
        <p class="text-lg font-medium">
            Already have an account? <a href="/login" class="underline hover:text-gray-200">Sign in here</a>
        </p>
    </div>

    <!--What we do vanney kura-->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 py-8 px-6 md:px-16 text-center">
        <div>
            <div class="flex justify-center mb-4">
                <img src="images/delivery.png" alt="Icon" class="w-16 h-16">
            </div>
            <h3 class="font-sm text-gray-800">Free Delivery Over <br>$50</h3>
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
    <div class="w-full px-4 py-12">
        <img src="images/banner.jpg" alt="Banner" class="w-full h-auto">
    </div>

    <h1 class="text-3xl md:text-4xl font-bold text-[#00718f] mb-2 mt-6 px-4">
        Shop our featured products selection
    </h1>
    <div class="h-1.5 w-20 bg-pink-600 ml-4 mb-4"></div>
    <div class="max-w-7xl mx-auto p-6 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($products as $product)
        <a href="#" class="block">
            <div class="bg-white border rounded-lg p-4 relative shadow hover:shadow-lg transition flex flex-col justify-between h-full">
                <div class="absolute top-2 left-2 bg-orange-500 text-white text-xs font-bold px-2 py-1 rounded">Featured</div>
                <!-- Image container with fixed aspect ratio and no cropping -->
                <div class="h-48 flex items-center justify-center bg-gray-100 rounded-lg mb-4 overflow-hidden">
                    <img src="{{ asset($product->image) }}" alt="Product Image" class="object-contain w-full h-full">
                </div>
                <div class="flex flex-col justify-between items-center text-center h-full">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">{{ $product->name }}</h3>
                    <p class="text-sm text-gray-900">
                        <span class="font-bold">{{ $product->brand->name }}</span> 
                    </p>
                    <div class="flex items-center mb-5 gap-1 text-yellow-500 text-sm my-2 justify-center">
                        <span class="text-pink-500 text-lg">★★★★★</span>
                        <span class="text-gray-600">(5 Reviews)</span>
                    </div>
                    <p class="text-lg font-semibold text-gray-900">${{ number_format($product->price, 2) }}</p>
                    <button class="inline-block bg-white border-2 border-[#00718f] text-[#00718f] font-lg font-bold px-4 py-2 rounded-[24px] hover:bg-[#00718f] hover:text-white transition-colors mt-4">
                        Add to Basket
                    </button>
                    <div class="flex gap-4 mt-4">
                        <span class="text-[#00718f] text-lg">
                            <i class="ri-heart-line"></i> Add Favourites
                        </span>
                        <span class="text-green-700 text-lg">
                            <i class="ri-arrow-left-right-fill"></i> Add to Compare
                        </span>
                    </div>
                </div>
            </div>
        </a>
        @endforeach
    </div>
    
    

    <!--Arko Banner image-->
    <div class="w-full px-4 py-14">
        <img src="images/banner1.jpg" alt="Banner" class="w-full h-auto">
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center py-8 px-6 md:px-16 bg-white">
        <!-- Video Section -->
        <div class="flex justify-center items-center">
            <iframe class="w-full max-w-md h-[250px] md:h-[300px] lg:h-[300px] shadow-lg rounded-lg"
                src="https://www.youtube.com/embed/WO2b03Zdu4Q" title="Alwayson Medical - Your Way" frameborder="0"
                allow="accelerometer; autoplay; encrypted-media; picture-in-picture" allowfullscreen>
            </iframe>
        </div>

        <!-- Text Section -->
        <div>
            <h1 class="text-3xl md:text-4xl font-extrabold text-[#00718f] mb-4">
                Welcome to <br>Alwayson Medical
            </h1>
            <div class="h-1 w-16 bg-pink-600 mb-4"></div>
            <p class="text-gray-700 text-lg leading-relaxed mb-6">
                Alwayson Medical is a social enterprise that provides choices for people living with a disability or
                other personal need, enabling them to regain and retain their independence within an inclusive community.
            </p>
            <a href="#"
                class="inline-block bg-white border-2 border-[#00718f] text-[#00718f] font-lg font-bold px-6 py-3 rounded-[24px] hover:bg-[#00718f] hover:text-white transition-colors">
                Our Story
            </a>
        </div>
    </div>
@endsection
