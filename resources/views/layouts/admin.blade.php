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
    <aside class="w-64 bg-white text-gray-900 shadow-lg flex flex-col">
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

    <!-- Main Content -->
    <main class="flex-1 p-8">
      @yield('content')
    </main>
  </div>

</body>

</html>
