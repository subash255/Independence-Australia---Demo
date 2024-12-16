<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PunchOut Catalog</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans antialiased">

    <!-- Header Section -->
    <header class="bg-gray-800 text-white py-6">
        <div class="container mx-auto text-center">
            <h1 class="text-3xl font-semibold">PunchOut Product Catalog</h1>
        </div>
    </header>

    <!-- Main Content Section -->
    <div class="container mx-auto p-6">
        @if(isset($error))
            <div class="bg-red-200 text-red-700 p-4 rounded-md mb-6">
                <p class="font-medium">Error: {{ $error }}</p>
            </div>
        @else
            @if(count($products) > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                    @foreach($products as $product)
                        <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                            <!-- Product Image -->
                            <img class="w-full h-48 object-cover rounded-md mb-4" src="{{ $product['image'] ?? 'https://via.placeholder.com/150' }}" alt="{{ $product['title'] }}">
                            
                            <!-- Product Title -->
                            <h3 class="text-lg font-semibold text-gray-800">{{ $product['title'] }}</h3>
                            
                            <!-- Product Price -->
                            <p class="text-green-500 font-medium mt-2">${{ number_format($product['price'], 2) }}</p>
                            
                            <!-- Product SKU -->
                            <p class="text-sm text-gray-500 mt-2">Id: {{ $product['id'] }}</p>
                            
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-center text-gray-600 text-xl mt-8">No products found or there was an issue fetching the catalog.</p>
            @endif
        @endif
    </div>

</body>
</html>
