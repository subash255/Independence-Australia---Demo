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
      <div class="flex justify-center mb-4 text-[#00718f] text-5xl">
        <i class="ri-truck-line"></i>
      </div>
      <h3 class="font-sm text-gray-800">Free Delivery Over $50</h3>
    </div>
  
    <div>
      <div class="flex justify-center mb-4 text-red-500 text-5xl">
        <i class="ri-heart-line"></i>
      </div>
      <h3 class="font-sm text-pink-600">Read our social <br>enterprise story</h3>
    </div>
  
    <div>
      <div class="flex justify-center mb-4 text-[#00718f] text-5xl">
        <i class="ri-hand-heart-line"></i>
      </div>
      <h3 class="font-sm text-gray-800">Registered NDIS <br>Service Provider</h3>
    </div>
  </div>


<div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center py-8 px-6 md:px-16 bg-white">
    <!-- Video Section -->
    <div class="flex justify-center">
      <iframe
        class="w-full max-w-md h-60 md:h-64 lg:h-80 shadow-lg"
        src="https://www.youtube.com/embed/WO2b03Zdu4Q"
        title="Independence Australia - Your Way"
        frameborder="0"
        allow="accelerometer; autoplay; encrypted-media; picture-in-picture"
        allowfullscreen>
      </iframe>
    </div>
  
    <div>
      <h1 class="text-3xl md:text-4xl font-extrabold text-[#00718f] mb-4">
        Welcome to <br>Independence Australia
      </h1>
      <div class="h-1 w-16 bg-pink-500 mb-4"></div>
      <p class="text-gray-700 text-lg leading-relaxed mb-6">
        Independence Australia is a social enterprise that provides choices for people living with a disability or other personal need, enabling them to regain and retain their independence within an inclusive community.
      </p>
      <a href="#"
         class="inline-block bg-white border-2 border-[#00718f] text-[#00718f] font-lg font-bold px-6 py-3 rounded-[24px] hover:bg-[#00718f] hover:text-white transition-colors">
        Our Story
      </a>
    </div>
  </div>
  

@endsection