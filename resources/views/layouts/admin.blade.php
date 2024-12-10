<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@100;300;400;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
  <script>
    let isCollapsed = false; 
    // Function to toggle the sidebar
    function toggleSidebar() {
      const sidebar = document.getElementById('sidebar');
      const sidebarLinks = document.querySelectorAll('.sidebar-link span');
      const logo = document.getElementById('logo');
      const toggleIcon = document.getElementById('toggle-icon');
      const header = document.getElementById('header');  

      // Toggle the state of the sidebar
      if (isCollapsed) {
        sidebar.classList.remove('w-20');
        sidebar.classList.add('w-64');
        // Show the logo and hide the toggle icon
        logo.classList.remove('hidden');
        toggleIcon.classList.add('hidden');
        
        // Show sidebar text
        sidebarLinks.forEach(link => {
          link.classList.remove('hidden');
        });

        // Move the header accordingly
        header.classList.remove('left-[5rem]');
        header.classList.add('left-[16rem]'); 
      } else {
        sidebar.classList.remove('w-64');
        sidebar.classList.add('w-20');
        // Hide the logo and show the toggle icon
        logo.classList.add('hidden');
        toggleIcon.classList.remove('hidden');
        
        // Hide sidebar text
        sidebarLinks.forEach(link => {
          link.classList.add('hidden');
        });

        // Move the header accordingly
        header.classList.remove('left-[16rem]');
        header.classList.add('left-[5rem]'); 
      }

      // Toggle the sidebar state
      isCollapsed = !isCollapsed;
    }
  </script>
</head>

<body class="bg-gray-100 text-gray-900 h-screen flex flex-col font-sans">

  <div class="flex flex-1 h-full">
    <!-- Sidebar -->
    <aside id="sidebar" class="w-64 bg-white text-gray-900 shadow-lg flex flex-col transition-all duration-300">
      <!-- Logo and toggle button -->
      <div class="p-4 flex items-center justify-center bg-white cursor-pointer" onclick="toggleSidebar()">
        <!-- The actual logo -->
        <img id="logo" src="{{ asset('images/logo.png') }}" alt="Logo" class="w-32 h-32 rounded-full border-2 border-gray-500 object-contain">
        
        <!-- The button (icon) to toggle the sidebar, initially hidden -->
        <button id="toggle-icon" onclick="toggleSidebar()" class="hidden px-4 py-2 bg-red-600 text-white rounded-full">
          <i class="ri-menu-3-fill"></i>
        </button>
      </div>

      <!-- Navigation Links -->
      <nav class="mt-6">
        <a href="{{ route('admin.dash') }}" class="sidebar-link flex items-center px-6 py-4 hover:bg-red-600 hover:text-white transition-colors duration-200">
          <i class="ri-layout-masonry-fill"></i>
          <span class="ml-4">Dashboard</span>
        </a>
        <a href="{{ route('admin.category.category') }}" class="sidebar-link flex items-center px-6 py-4 hover:bg-red-600 hover:text-white transition-colors duration-200">
          <i class="ri-grid-line"></i>
          <span class="ml-4">Category</span>
        </a>
        <a href="#" class="sidebar-link flex items-center px-6 py-4 hover:bg-red-600 hover:text-white transition-colors duration-200">
          <i class="ri-admin-fill"></i>
          <span class="ml-4">Manage Admin</span>
        </a>
        <a href="#" class="sidebar-link flex items-center px-6 py-4 hover:bg-red-600 hover:text-white transition-colors duration-200">
          <i class="ri-price-tag-fill"></i>
          <span class="ml-4">Brands</span>
        </a>
        <a href="#" class="sidebar-link flex items-center px-6 py-4 hover:bg-red-600 hover:text-white transition-colors duration-200">
          <i class="ri-shopping-cart-2-fill"></i>
          <span class="ml-4">Orders</span>
        </a>
        <a href="{{ route('admin.product.product') }}" class="sidebar-link flex items-center px-6 py-4 hover:bg-red-600 hover:text-white transition-colors duration-200">
          <i class="ri-bank-card-2-fill"></i>
          <span class="ml-4">Products</span>
        </a>
      </nav>
    </aside>

    <!-- Header Section -->
    <div id="header" class="bg-red-600 text-white flex items-center justify-between px-8 py-[5rem] fixed top-0 left-[16rem] right-0 shadow-lg z-10">
      <h1 class="text-3xl font-semibold mt-[-2rem]">{{ $title ?? 'Default Title' }}</h1>
      <div class="flex items-center space-x-4">
        <div class="relative group">
          <div class="flex items-center mt-[-2rem] text-lg font-medium hover:text-white focus:outline-none cursor-pointer px-2 py-3">
            <span>Developer</span>
            <i class="ri-arrow-down-s-line text-white"></i>
          </div>

          <!-- Dropdown Menu -->
          <div class="absolute right-0 mt-[-2rem] w-40 bg-white text-gray-800 rounded-md shadow-lg hidden group-hover:block z-[50]">
            <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100">Profile</a>
            <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100">Log Out</a>
          </div>
        </div>

        <button class="hover:bg-red-500 mt-[-2rem] transition ease-in-out duration-200">
          <i class="ri-moon-fill"></i>
        </button>
      </div>
    </div>

    <!-- Main Content -->
    <main class="flex-1 p-8">
      @yield('content')
    </main>
  </div>

</body>

</html>
