<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@100;300;400;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
</head>

<body class="bg-gray-100 text-gray-900 h-screen flex flex-col font-sans">

  <div class="flex flex-1 h-full">
    <!-- Sidebar -->
    <aside id="sidebar" class="w-64 bg-white text-gray-900 shadow-lg flex flex-col transition-all duration-300 ease-in-out">
      <!-- Hamburger Menu Button (for mobile) -->
      <button id="hamburger" class="lg:hidden text-white rounded-md hover:bg-red-500 transition duration-200 p-4 absolute top-4 left-4 z-20">
        <i id="hamburger-icon" class="ri-menu-3-line"></i>
      </button>

      <!-- Logo and title -->
      <div class="p-4 flex items-center justify-center bg-white">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-32 h-32 rounded-full border-2 border-gray-500 object-contain">
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

    <!-- Header Section (unchanged as per your request) -->
    <div class="bg-red-600 text-white flex items-center justify-between px-8 py-[5rem] fixed top-0 left-[16rem] right-0 shadow-lg z-10">
      <h1 class="text-3xl font-semibold mt-[-2rem]">{{ $title ?? 'Default Title' }}</h1>

      <!-- User Profile and Theme Toggle -->
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
    <main id="main-content" class="flex-1 p-8 ml-64 lg:ml-0 transition-all duration-300 ease-in-out">
      @yield('content')
    </main>
  </div>

  <script>
    // JavaScript to toggle sidebar visibility on mobile
    const hamburger = document.getElementById('hamburger');
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('main-content');
    const hamburgerIcon = document.getElementById('hamburger-icon');

    hamburger.addEventListener('click', () => {
      sidebar.classList.toggle('w-16');  // Toggle width of sidebar
      sidebar.classList.toggle('w-64');  // Toggle width of sidebar

      mainContent.classList.toggle('ml-0');  // Adjust main content when sidebar is hidden

      // Toggle hamburger and close icon
      if (sidebar.classList.contains('w-16')) {
        hamburgerIcon.classList.remove('ri-close-line');
        hamburgerIcon.classList.add('ri-menu-3-line');
      } else {
        hamburgerIcon.classList.remove('ri-menu-3-line');
        hamburgerIcon.classList.add('ri-close-line');
      }

      // Toggle visibility of text in sidebar (show text when expanded, hide when collapsed)
      const sidebarLinks = sidebar.querySelectorAll('nav a span');
      sidebarLinks.forEach(link => {
        link.classList.toggle('hidden'); // Hide text when collapsed
      });
    });
  </script>
</body>

</html>
