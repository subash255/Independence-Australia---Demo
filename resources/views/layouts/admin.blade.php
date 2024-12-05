<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-800 text-white h-screen">
            <div class="p-4 text-center text-lg font-bold border-b border-gray-700">
                Admin Panel
            </div>
            <nav class="mt-4">
                <ul>
                    <li class="hover:bg-gray-700">
                        <a href="{{route('admin.dash')}}" class="block py-2 px-4">Dashboard</a>
                    </li>
                    <li class="hover:bg-gray-700">
                        <a href="{{route('admin.product')}}" class="block py-2 px-4">Products Details</a>
                    </li>
                    <li class="hover:bg-gray-700">
                        <a href="" class="block py-2 px-4">Manage carts</a>
                    </li>
                    <li class="hover:bg-gray-700">
                        <a href="" class="block py-2 px-4">Manage Users</a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6">
            <div class="text-gray-900">
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>
