@extends('layouts.master')
@section('content')


@auth
    <!-- This section is shown when the user is logged in -->
    <div class="p-6 items-center justify-between bg-cover bg-center" style="background-image: url('/images/dr.jpg');">
        <div class="my-8 ml-8 max-w-7xl mx-auto">
            <!-- Breadcrumbs -->
            <div class="text-sm text-gray-500">
                <a href="/" class="hover:text-[#00718f]">Home</a> |
                <a href="{{route('user.welcome')}}"><span>Dashboard</span></a>
            </div>

            <!-- Welcome Heading -->
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold text-[#00718f] mt-2">Welcome {{ Auth::user()->name }}!</h1>

            <hr class="border-b border-gray-300 mt-2 mb-2 w-3/4 sm:w-2/4 md:w-1/4">

            <p class="text-gray-600 mt-1 text-base sm:text-lg md:text-xl">
                You are currently managing <br>
                <span class="font-semibold text-[#00718f]">{{ Auth::user()->name }} {{ Auth::user()->last_name }}  @if(Auth::user()->role == 'vendor')  B2B
                    Customer</span> @endif
            </p>

       <!-- Check if the current user is a vendor, then show the Switch Account Button -->
       @if(Auth::user()->role == 'vendor') <!-- Adjust this condition based on how you define a vendor -->
       <button class="mt-4 flex items-center bg-[#00718f] text-white px-4 py-2 rounded-lg hover:bg-[#00718f]" onclick="toggleDropdown()">
           <i class="ri-refresh-line pr-2"></i>
           Switch Account
       </button>

            <div id="user-dropdown" class="hidden bg-white shadow-lg rounded-lg mt-2 absolute z-30 w-80 sm:w-1/4 max-h-60 overflow-y-auto">
                <ul class="py-2">
                    @foreach ($users as $user)
                    <!-- Loop through users and display them -->
                    <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer">
                        <a href="{{ route('impersonate', $user->id) }}" class="block">
                            {{ $user->name }} {{ $user->last_name }} 
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
    </div>
@endauth

{{-- Check if the user is not logged in --}}
@guest
    <!-- This section is shown when the user is not logged in -->
     <!-- <div class="relative flex flex-col md:flex-row-reverse items-center bg-gray-100 p-8 md:p-16 gap-10 md:gap-18">
        <div class="absolute inset-0 bg-cover bg-center"
            style="background-image: url('{{ asset('images/suddo.jpg') }}'); height: 400px;">
            <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent"></div>
        </div>

        <div class="relative z-10 text-center md:text-left w-full md:w-1/2 text-white px-6">
            <h1 class="text-teal-700 text-3xl md:text-4xl font-bold mb-4 text-shadow-md">
                Welcome to Alwayson Medical
            </h1>
            <p class="text-sm md:text-base leading-relaxed text-gray-900 mb-6">
                Alwayson Medical is a social enterprise that provides choices for people living with a disability or
                other personal need, enabling them to regain and retain their independence within an inclusive community.
            </p>

            <div class="space-y-4 md:space-y-0 md:flex md:flex-col md:gap-4">
                <a href="/login"><button
                    class="py-[10px] px-[20px] bg-[#00718f] text-white font-bold rounded-[24px] border-2 border-[#00718f] hover:bg-[#ffffff] hover:text-[#00718f] transition">
                    Sign in
                </button></a>
                
                <p class="text-sm text-gray-300">
                    Don't have an account yet? 
                    <a href="/register" class="text-teal-700 font-medium hover:underline">Register now</a>
                </p>
            </div>
        </div>
    </div>  -->

    <div class="relative w-full overflow-hidden">
    <!-- Slider Wrapper -->
    <div id="slider" class="flex transition-transform duration-700 ease-in-out">
        @foreach($images as $image)
            <div class="w-full flex-shrink-0">
                <img src="{{ asset('banner/' . $image->image) }}" alt="Image {{ $image->id }}" class="w-full h-64 object-cover">
            </div>
        @endforeach
    </div>

    <!-- Navigation buttons -->
    <button id="prev"
    class="absolute top-1/2 left-0 transform -translate-y-1/2 bg-gray-800 text-white p-2 rounded-full z-10 md:p-3 md:left-2 opacity-45">
    &#10094;
</button>
<button id="next"
    class="absolute top-1/2 right-0 transform -translate-y-1/2 bg-gray-800 text-white p-2 rounded-full z-10 md:p-3 md:right-2 opacity-45">
    &#10095;
</button>
</div>
@endguest


    <!--Banner images-->
    {{-- <div class="w-full px-4 py-12 banner mt-4">
        <img src="images/homepage.jpg" alt="Banner"
            class="w-full h-auto transform transition-all duration-300 ease-in-out shadow-lg">
    </div>


    <div class="w-full px-4 py-6">
        <img src="images/banner.jpg" alt="Banner" class="w-full h-auto">
    </div> --}}

    {{-- <h1 class="text-3xl md:text-4xl font-bold text-[#00718f] mb-2 mt-6 px-4">
        Shop by Category
    </h1>
    <div class="h-1.5 w-20 bg-pink-600 ml-4 mb-4"></div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 p-6">
        <!-- Continence Aids-->
       <a href="{{route('menu.index')}}"> <div class="relative row-span-2 overflow-hidden">
            <img src="{{ asset('images/category/1.jpg') }}" alt="Continence Aids"
                class="w-full h-full object-cover transform transition-transform duration-300 hover:scale-110">
        </div> </a>

        <!-- Nutrition -->
        <div class="relative overflow-hidden">
            <img src="{{ asset('images/category/4.jpg') }}" alt="Nutrition"
                class="w-full h-full object-cover transform transition-transform duration-300 hover:scale-110">
        </div>

        <!-- Wound Care -->
        <div class="relative overflow-hidden">
            <img src="{{ asset('images/category/8.jpg') }}" alt="Wound Care"
                class="w-full h-full object-cover transform transition-transform duration-300 hover:scale-110">
        </div>

        <!-- Skin Care -->
        <div class="relative overflow-hidden">
            <img src="{{ asset('images/category/6.jpg') }}" alt="Skin Care"
                class="w-full h-full object-cover transform transition-transform duration-300 hover:scale-110">
        </div>

        <!-- Medical Aids -->
        <div class="relative overflow-hidden">
            <img src="{{ asset('images/category/3.jpg') }}" alt="Medical Aids"
                class="w-full h-full object-cover transform transition-transform duration-300 hover:scale-110">
        </div>

        <!-- Daily Living & Mobility Aids -->
        <div class="relative overflow-hidden">
            <img src="{{ asset('images/category/2.jpg') }}" alt="Daily Living & Mobility Aids"
                class="w-full h-full object-cover transform transition-transform duration-300 hover:scale-110">
        </div>

        <!-- Urology -->
        <div class="relative overflow-hidden">
            <img src="{{ asset('images/category/7.jpg') }}" alt="Urology"
                class="w-full h-full object-cover transform transition-transform duration-300 hover:scale-110">
        </div>

        <!-- Other -->
        <div class="relative overflow-hidden">
            <img src="{{ asset('images/category/5.jpg') }}" alt="Other"
                class="w-full h-full object-cover transform transition-transform duration-300 hover:scale-110">
        </div>
    </div> --}}

    <!--Arko Banner image-->
    <div class="w-full px-4 py-10">
        <img src="images/banner1.jpg" alt="Banner" class="w-full h-auto">
    </div>

    <h1 class="text-3xl md:text-4xl font-bold text-[#00718f] mb-2 mt-6 px-4">
        Shop our featured products 
    </h1>
    <div class="h-1.5 w-20 bg-pink-600 ml-4 mb-4"></div>
    <div class="max-w-7xl mx-auto p-6 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($products as $product)
        <a href="{{ route('product.show', ['id' => $product->id]) }}" class="block">
            <div class="bg-white border rounded-lg p-4 relative shadow hover:shadow-lg transition flex flex-col justify-between h-full">
                <div class="absolute top-2 left-2 bg-orange-500 text-white text-xs font-bold px-2 py-1 rounded">Featured</div>
                <!-- Image container with fixed aspect ratio and no cropping -->
                <div class="h-48 flex items-center justify-center bg-gray-100 rounded-lg mb-2 overflow-hidden">
                    <img src="{{ asset($product->image) }}" alt="Product Image" class="object-contain w-full h-full">
                </div>
                <div class="flex flex-col justify-between items-center text-center h-full">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $product->name }}</h3>
                    <p class="text-sm text-gray-900">
                        <span class="font-bold">{{ $product->brand->name }}</span> 
                    </p>
                    <div class="flex items-center mb-3 gap-1 text-yellow-500 text-sm justify-center">
                        <span class="text-pink-500 text-lg">★★★★★</span>
                        <span class="text-gray-600">(5 Reviews)</span>
                    </div>
                    <p class="text-lg font-semibold text-gray-900">${{ number_format($product->price, 2) }}</p>
                    <form action="{{ route('user.cart.add', $product->id) }}" method="POST">
                        @csrf
                    <button type="submit" class="inline-block bg-white border-2 border-[#00718f] text-[#00718f] font-lg font-bold px-4 py-2 rounded-[24px] hover:bg-[#00718f] hover:text-white transition-colors mt-2">
                        Add to Basket
                    </button>
                    </form>
                    {{-- <div class="flex gap-4 mt-4">
                        <span class="text-[#00718f] text-lg">
                            <i class="ri-heart-line"></i> Add Favourites
                        </span>
                        <span class="text-green-700 text-lg">
                            <i class="ri-arrow-left-right-fill"></i> Add to Compare
                        </span>
                    </div> --}}
                </div>
            </div>
        </a>
        @endforeach
    </div>
    


    {{-- <h1 class="text-3xl md:text-4xl font-bold text-[#00718f] mb-2 mt-6 px-4">
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
    </div> --}}


    {{-- <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center py-8 px-6 md:px-16 bg-gray-100">
        <!-- Image Section -->
        <div class="flex justify-center items-center">
            <img class="w-full h-auto shadow-lg rounded-lg" src="images/wheel.jpg" alt="Alwayson Medical" />
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
        Explore our publications
    </h1>
    <div class="h-1.5 w-20 bg-pink-600 ml-4 mb-10"></div>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 p-6">
        <!-- Book 1 -->
        <div class="relative overflow-hidden">
            <img src="{{ asset('images/p1.jpg') }}" alt="Book 1"
                class="w-full h-64 object-contain transform transition-transform duration-300 hover:scale-105">
        </div>
    
        <!-- Book 2 -->
        <div class="relative overflow-hidden">
            <img src="{{ asset('images/p2.jpg') }}" alt="Book 2"
                class="w-full h-64 object-contain transform transition-transform duration-300 hover:scale-105">
        </div>
    
        <!-- Book 3 -->
        <div class="relative overflow-hidden">
            <img src="{{ asset('images/p3.jpg') }}" alt="Book 3"
                class="w-full h-64 object-contain transform transition-transform duration-300 hover:scale-105">
        </div>
    </div>
    
    <!-- View More Button -->
    <div class="flex justify-center mt-8 pb-4">
        <a href="#"
            class="py-[10px] px-[20px] bg-[#00718f] text-white font-bold rounded-[24px] border-2 border-[#00718f] hover:bg-[#ffffff] hover:text-[#00718f] transition">
            View more publications
        </a>
    </div>
     --}}


    <hr class="border-gray-300">
    <div class="w-full bg-white">
        <div class="w-full px-4 md:px-[8rem] flex flex-col items-center"> <!-- Adjusted padding for responsiveness -->
            <p id="text" class="text-black text-lg py-7 text-center">
                Alwayson Medical supplies healthcare and medical supplies to thousands of customers across Australia.
                We stock all major and specialist brands. Key categories include continence, wound care, daily living & mobility aids,
                urology, skin care, medical aids & nutrition. <br>
                <span id="more-text" class="hidden">
                    Shop our complete range of products online to receive free shipping over $50, courier tracking and
                    optional discreet packaging.
                    We can make the purchase of your personal and medical supplies easy by providing quick delivery of more
                    than 13,000 products directly to your home, anywhere in Australia. <br>
                    Alwayson Medical also has a unique social enterprise approach that leverages the sale of
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
            event.preventDefault();

        
            if (moreText.classList.contains('hidden')) {
                moreText.classList.remove('hidden');
                toggleBtn.textContent = 'Less'; 
            } else {
                moreText.classList.add('hidden');
                toggleBtn.textContent = 'More'; 
            }
        });

    </script>

<script>
    let currentIndex = 0;
    const slider = document.getElementById('slider');
    const totalSlides = @json(count($images));  // Dynamically embedding the number of slides

    const showSlide = (index) => {
        // Ensure index is within bounds
        if (index < 0) index = totalSlides - 1;
        if (index >= totalSlides) index = 0;
        
        const offset = -index * 100;
        slider.style.transform = `translateX(${offset}%)`;
    };

    // Next button functionality
    document.getElementById("next").addEventListener("click", () => {
        currentIndex = (currentIndex + 1) % totalSlides;
        showSlide(currentIndex);
        resetAutoSlide();
    });

    // Prev button functionality
    document.getElementById("prev").addEventListener("click", () => {
        currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
        showSlide(currentIndex);
        resetAutoSlide();
    });

    // Automatic sliding every 3 seconds
    let autoSlideInterval;
    const startAutoSlide = () => {
        autoSlideInterval = setInterval(() => {
            currentIndex = (currentIndex + 1) % totalSlides;
            showSlide(currentIndex);
        }, 3000);
    };

    const resetAutoSlide = () => {
        clearInterval(autoSlideInterval);  // Reset auto-slide interval
        startAutoSlide();  // Restart the auto-slide interval
    };

    startAutoSlide(); // Start auto-sliding when the page loads
    showSlide(currentIndex); // Initialize the first slide
</script>



@endsection
