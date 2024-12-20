@extends('layouts.admin')

@section('content')
    {{-- Flash Message --}}
    @if (session('success'))
        <div id="flash-message" class="bg-green-500 text-white px-6 py-2 rounded-lg fixed top-4 right-4 shadow-lg z-50">
            {{ session('success') }}
        </div>
    @endif

    <script>
        if (document.getElementById('flash-message')) setTimeout(() => {
            const msg = document.getElementById('flash-message');
            msg.style.opacity = 0;
            msg.style.transition = "opacity 0.5s ease-out";
            setTimeout(() => msg.remove(), 500);
        }, 3000);
    </script>

    <!-- Main container -->
    <div class="max-w-full mx-auto p-4 bg-white shadow-lg mt-[7rem] rounded-lg relative z-10">
        <div class="mb-4 flex justify-end space-x-4">
            <button id="openModalButton"
                class="text-red-500 font-medium bg-white border-2 border-red-500 rounded-lg py-2 px-4 hover:bg-red-600 hover:text-white transition duration-300">
                Add product
            </button>
        </div>

        <!-- Modal Structure -->
        <div id="productModal"
            class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center hidden z-50 backdrop-blur-[1px]">
            <div class="bg-white rounded-lg p-6 w-full max-w-md relative">
                <h2 class="text-xl font-semibold text-center">Add Product</h2>
                <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label for="csv_file" class="block text-gray-700 text-sm font-medium">CSV File</label>
                    <input type="file" name="csv_file" id="csv_file"
                        class="mt-2 block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none text-gray-700 text-sm shadow-sm"
                        accept=".csv, .xlsx" required>
                    <div class="flex justify-end mt-4">
                        <!-- Close Button -->
                        <button type="button" id="closeModalButton"
                            class="bg-gray-400 text-white py-2 px-4 rounded-lg mr-2 hover:bg-gray-500 hover:shadow-md transition duration-300">
                            Close
                        </button>

                        <!-- Add Product Button -->
                        <button type="submit"
                            class="bg-red-500 text-white py-2 px-4 rounded-lg hover:bg-red-600 hover:shadow-md transition duration-300">
                            Add Product
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="flex justify-between mb-4">
            <!-- Left: Show entries with tag above -->
            <div class="flex items-center space-x-2">
                <label for="entries" class="mr-2">Show entries:</label>
                <select id="entries" class="border border-gray-300 px-5 py-1 w-full sm:w-auto pr-10"
                    onchange="updateEntries()">
                    <option value="5" {{ request('entries') == 5 ? 'selected' : '' }}>5</option>
                    <option value="15" {{ request('entries') == 15 ? 'selected' : '' }}>15</option>
                    <option value="25" {{ request('entries') == 25 ? 'selected' : '' }}>25</option>
                </select>
            </div>

            <!-- Right: Search with label beside -->
            <div class="flex items-center space-x-2">
                <span class="text-gray-700">Search:</span>
                <input type="text" id="search" placeholder="Search..."
                    class="border border-gray-300 px-4 py-2 w-96" />
            </div>
        </div>

        <!-- Table Container with horizontal scroll if needed -->
        <div class="overflow-x-auto">
            <table class="min-w-full border-collapse border border-gray-300 table-auto">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border border-gray-300 px-2 py-2 font-medium">S.N</th>
                        <th class="border border-gray-300 px-2 py-2 font-medium">SKU</th>
                        <th class="border border-gray-300 px-2 py-2 font-medium">Photo</th>
                        <th class="border border-gray-300 px-2 py-2 font-medium">Category</th>
                        <th class="border border-gray-300 px-7 py-2 font-medium">Short Description</th>
                        <th class="border border-gray-300 px-7 py-2 font-medium">Name</th>
                        <th class="border border-gray-300 px-7 py-2 font-medium">Brand</th>
                        <th class="border border-gray-300 px-7 py-2 font-medium">Price</th>
                        <th class="border border-gray-300 px-2 py-2 font-medium">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr class="border border-gray-300 product-row" data-product-id="{{ $product->id }}">
                            <td class="border border-gray-300 px-4 py-2">{{ $loop->iteration }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $product->sku }}</td>
                            <td class="border border-gray-300 px-4 py-2">
                                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}"
                                    class="w-16 h-16 object-cover rounded-full" />
                            </td>
                            <td class="border border-gray-300 px-4 py-2">{{ $product->category }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $product->short_description }}</td>
                            <td class="border border-gray-300 px-7 py-2">{{ $product->name }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $product->brand }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $product->price }}</td>
                            <td class="px-2 py-2 mt-4 flex justify-center space-x-2">
                                <button
                                    class="text-white bg-blue-500 hover:bg-blue-700 w-8 h-8 flex items-center justify-center rounded-md">
                                    <i class="ri-alarm-line text-sm"></i>
                                </button>
                                <button
                                    class="text-white bg-red-500 hover:bg-red-700 w-8 h-8 flex items-center justify-center rounded-md">
                                    <i class="ri-close-line text-sm"></i>
                                </button>
                                <button
                                    class="text-white bg-green-500 hover:bg-green-700 w-8 h-8 flex items-center justify-center rounded-md">
                                    <i class="ri-check-line text-sm"></i>
                                </button>
                                <a href="{{ route('admin.product.show', $product->id) }}">
                                    <button
                                        class="text-white bg-green-500 hover:bg-green-700 w-8 h-8 flex items-center justify-center rounded-md">
                                        <i class="ri-eye-line text-sm"></i>
                                    </button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination and Show Entries Section at the Bottom -->
        <div class="flex justify-between items-center mt-4 ">
            <div class="flex items-center space-x-5 bg-white p-2 rounded-lg shadow-sm w-full">
                <!-- Pagination Links -->
                <div class="flex space-x-1 ml-[8rem]">
                    <!-- Apply custom Tailwind classes for pagination -->
                    {{ $products->appends(['status' => request('status')])->links() }}
                </div>
            </div>
        </div>

    </div>


    <script>
        // Get modal and button references
        const openModalButton = document.getElementById('openModalButton');
        const closeModalButton = document.getElementById('closeModalButton');
        const modal = document.getElementById('productModal');

        // Show the modal when the button is clicked
        openModalButton.addEventListener('click', () => {
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden'; // Disable scrolling when modal is open
        });

        // Close the modal when the close button is clicked
        closeModalButton.addEventListener('click', () => {
            modal.classList.add('hidden');
            document.body.style.overflow = ''; // Re-enable scrolling
        });

        // Optionally, close the modal if clicked outside of it
        window.addEventListener('click', (event) => {
            if (event.target === modal) {
                modal.classList.add('hidden');
                document.body.style.overflow = ''; // Re-enable scrolling
            }
        });
    </script>
@endsection
