@extends('layouts.admin')

@section('content')

<!-- Header Section -->
<div class="bg-red-600 text-white flex items-center justify-between px-8 pb-12 pt-8 absolute top-0 left-0 right-0 shadow-lg mb-6 -z-30">
  <h1 class="text-3xl font-bold ml-80 py-0">Dashboard</h1>
  
  <div class="flex items-center space-x-6">
    <div class="relative group">
      <div class="flex items-center space-x-2 text-lg font-medium hover:text-white focus:outline-none cursor-pointer px-6 py-3">
        <span>Developer</span>
        <i class="ri-arrow-down-s-line text-white"></i>
      </div>

      <!-- Dropdown Menu-->
      <div class="absolute right-0 mt-2 w-40 bg-white text-gray-800 rounded-md shadow-lg hidden group-hover:block">
        <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100">Profile</a>
        <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100">Settings</a>
        <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100">Log Out</a>
      </div>
    </div>

    <button class="hover:bg-red-500 transition ease-in-out duration-200">
      <i class="ri-moon-fill"></i>
    </button>
  </div>
</div>

<!-- Cards Section-->
<div class="relative z-20 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 pt-24 px-6">
  <!-- Pending Orders Card -->
  <div class="bg-white p-6 text-left hover:shadow-2xl flex flex-row items-center justify-between w-full h-20 rounded-lg transform -translate-y-12 shadow-lg">
    <div>
      <h2 class="text-gray-700 font-medium">Pending Orders</h2>
      <p class="text-gray-700 font-medium">1</p>
    </div>
    <div class="bg-yellow-500 text-white w-12 h-12 flex items-center justify-center rounded-full">
      <i class="ri-time-line text-2xl"></i> 
    </div>
  </div>

  <!-- Processing Orders Card -->
  <div class="bg-white p-6 rounded-lg text-left hover:shadow-2xl transition-shadow duration-300 flex flex-row items-center justify-between w-full h-20 transform -translate-y-12 shadow-lg">
    <div>
      <h2 class="text-gray-700 font-medium mb-2">Processing Orders</h2>
      <p class="text-gray-700 font-medium">1</p>
    </div>
    <div class="bg-yellow-600 text-white w-12 h-12 flex items-center justify-center rounded-full">
      <i class="ri-settings-2-line text-2xl"></i> 
    </div>
  </div>

  <!-- Income Card -->
  <div class="bg-white p-6 rounded-lg text-left hover:shadow-2xl transition-shadow duration-300 flex flex-row items-center justify-between w-full h-20 transform -translate-y-12 shadow-lg">
    <div>
      <h2 class="text-gray-700 font-medium mb-2">Income</h2>
      <p class="text-gray-700 font-medium">$400</p>
    </div>
    <div class="bg-purple-600 text-white w-12 h-12 flex items-center justify-center rounded-full">
      <i class="ri-money-dollar-circle-fill text-2xl"></i> 
    </div>
  </div>
</div>

<div class="relative z-20 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 px-6 mt-0">
  <!-- Visitors Card -->
  <div class="bg-white p-6 rounded-lg text-left hover:shadow-2xl transition-shadow duration-300 flex flex-row items-center justify-between w-full h-20 transform -translate-y-4 shadow-lg">
    <div>
      <h2 class="text-gray-700 font-medium mb-2">Orders</h2>
      <p class="text-gray-700 font-medium">142</p>
    </div>
    <div class="bg-green-500 text-white w-12 h-12 flex items-center justify-center rounded-full">
      <i class="ri-cart-fill text-2xl"></i> 
    </div>
  </div>

  <!-- Revenue -->
  <div class="bg-white p-6 rounded-lg text-left hover:shadow-2xl transition-shadow duration-300 flex flex-row items-center justify-between w-full h-20 transform -translate-y-4 shadow-lg">
    <div>
      <h2 class="text-gray-700 font-medium mb-2">Revenue</h2>
      <p class="text-gray-700 font-medium">100</p>
    </div>
    <div class="bg-blue-500 text-white w-12 h-12 flex items-center justify-center rounded-full">
      <i class="ri-money-dollar-circle-fill text-2xl"></i> 
    </div>
  </div>

  <!-- Visitors-->
  <div class="bg-white p-6 rounded-lg text-left hover:shadow-2xl transition-shadow duration-300 flex flex-row items-center justify-between w-full h-20 transform -translate-y-4 shadow-lg">
    <div>
      <h2 class="text-gray-700 font-medium mb-2">Visitors</h2>
      <p class="text-gray-700 font-medium">200</p>
    </div>
    <div class="bg-red-500 text-white w-12 h-12 flex items-center justify-center rounded-full">
      <i class="ri-earth-fill text-2xl"></i> 
    </div>
  </div>
</div>

@endsection
