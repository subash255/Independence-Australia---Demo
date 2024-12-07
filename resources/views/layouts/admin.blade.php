<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans antialiased">

    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-800 text-white h-full flex flex-col">
            <div class="p-6 text-center text-2xl font-semibold border-b border-gray-700">
                Admin Panel
            </div>
            <nav class="mt-4 flex-1">
                <ul>
                    <li class="hover:bg-gray-700">
                        <a href="{{route('admin.dash')}}" class="py-3 px-6 text-lg flex items-center hover:text-white transition duration-300">
                            <i class="ri-dashboard-fill text-xl mr-3"></i> Dashboard
                        </a>
                    </li>
                    <li class="hover:bg-gray-700">
                        <a href="{{route('admin.product')}}" class="py-3 px-6 text-lg flex items-center hover:text-white transition duration-300">
                            <i class="ri-settings-4-fill text-xl mr-3"></i> Products Details
                        </a>
                    </li>
                    <li class="hover:bg-gray-700">
                        <a href="#" class="py-3 px-6 text-lg flex items-center hover:text-white transition duration-300">
                            <i class="ri-shopping-cart-2-fill text-xl mr-3"></i> Manage Carts
                        </a>
                    </li>
                    <li class="hover:bg-gray-700">
                        <a href="#" class="py-3 px-6 text-lg flex items-center hover:text-white transition duration-300">
                            <i class="ri-user-fill text-xl mr-3"></i> Manage Users
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6 overflow-auto h-full bg-white">
            <div class="text-gray-900">
                @yield('content')
            </div>
        </main>
    </div>

</body>
</html>
