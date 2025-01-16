@extends('layouts.admin')
@section('content')
<style>
    /* Hide the modal */
    .modal-hidden {
        display: none !important;
    }

    /* Show the modal with flex */
    .modal-visible {
        display: flex !important;
    }
</style>

    <!-- Main container -->
    <div class="p-4 bg-white shadow-lg -mt-12 mx-4 z-20 rounded-lg">
        <div class="mb-4 flex justify-end space-x-4">
            <button id="openModalButton"
                class="text-blue-500 font-medium bg-white border-2 border-blue-500 rounded-lg py-2 px-4 hover:bg-blue-600 hover:text-white transition duration-300">
                Add product
            </button>
        </div>

        <!-- Modal Structure -->
        <div id="productModal"
        class="fixed inset-0 bg-black bg-opacity-70 modal-hidden items-center justify-center z-50 backdrop-blur-[1px]">
            <div class="bg-white rounded-lg p-6 w-full max-w-md relative">
                <h2 class="text-xl font-semibold text-center">Add Product</h2>
                <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label for="csv_file" class="block text-gray-700 text-sm font-medium">CSV File</label>
                    <input type="file" name="csv_file" id="csv_file"
                        class="mt-2 block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none text-gray-700 text-sm shadow-sm"
                        accept=".csv, .xlsx" required>
                        <div class="flex justify-between gap-4 mt-8">
                            <!-- Close Button -->
                            <button type="button" id="closeModalButton"
                            class="w-full md:w-auto font-semibold bg-red-500 text-white py-2 px-4 rounded-lg hover:bg-red-600 transition duration-300 focus:outline-none">
                            Cancel
                        </button>

                            <!-- Submit Button -->
                            <button type="submit"
                                class="w-full md:w-auto bg-gradient-to-r from-indigo-600 to-indigo-700 text-white font-semibold py-2 px-6 rounded-lg hover:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-300 transform hover:scale-105">
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
            <table id="productTable" class="min-w-full border-collapse border border-gray-300 table-auto">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border border-gray-300 px-2 py-2 font-medium">S.N</th>
                        <th class="border border-gray-300 px-2 py-2 font-medium">SKU</th>
                        <th class="border border-gray-300 px-2 py-2 font-medium">Photo</th>
                        <th class="border border-gray-300 px-2 py-2 font-medium">Category</th>
                        <th class="border border-gray-300 px-7 py-2 font-medium">Short Description</th>
                        <th class="border border-gray-300 px-7 py-2 font-medium">Name</th>
                        <th class="border border-gray-300 px-7 py-2 font-medium">Brand</th>
                    <th class="border border-gray-300 px-4 py-2">Status</th>
                        <th class="border border-gray-300 px-7 py-2 font-medium">Price</th>
                        <th class="border border-gray-300 px-2 py-2 font-medium">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr class="border border-gray-300 product-row" data-product-id="{{ $product->id }}">
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $loop->iteration }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $product->sku }}</td>
                            <td class="border border-gray-300 px-4 py-2">
                                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}"
                                    class="w-16 h-16 object-cover rounded-full" />
                            </td>

                            <td class="border border-gray-300 px-4 py-2">{{ $product->category->name }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $product->short_description }}</td>
                            <td class="border border-gray-300 px-7 py-2">{{ $product->name }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $product->brand->name }}</td>
                            <td class="border border-gray-300 px-4 py-2">
                                <label for="status{{ $product->id }}" class="inline-flex items-center cursor-pointer">
                                <input id="status{{ $product->id }}" type="checkbox" class="hidden toggle-switch" data-id="{{ $product->id }}" {{ $product->status ? 'checked' : '' }} />

                                    <div class="w-10 h-6 bg-gray-200 rounded-full relative">
                                        <div class="dot absolute left-1 top-1 w-4 h-4 bg-white rounded-full transition">
                                        </div>
                                    </div>
                                </label>
                            </td>
                            <td class="border border-gray-300 px-4 py-2">{{ $product->price }}</td>
                            <td class="px-4 py-2 mt-4 flex justify-center space-x-2">
                                {{-- <button
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
                                </a> --}}

                                <form action="{{ route('admin.product.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this Product?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-500 hover:bg-red-700 p-1 w-8 h-8 rounded-full flex items-center justify-center">
                                        <i class="ri-delete-bin-line text-white"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    <!-- Pagination and Show Entries Section at the Bottom -->
    <div class="flex justify-between items-center mt-4">
        <div class="flex items-center space-x-2">
            <span class="ml-4 text-gray-700">
                Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} of {{ $products->total() }}
                entries
            </span>
        </div>

        <div class="flex items-center space-x-2">
            {{ $products->links() }}
        </div>
    </div>


    </div>

<script>
function updateEntries() {
        const entries = document.getElementById('entries').value;
        const url = new URL(window.location.href);
        url.searchParams.set('entries', entries);
        window.location.href = url;
    }

      document.querySelectorAll('.toggle-switch').forEach(toggle => {
    const dot = toggle.parentNode.querySelector('.dot'); // The visual dot for the toggle switch

    // Apply the correct initial state (visual toggle)
    if (toggle.checked) {
        dot.style.transform = 'translateX(100%)';
        dot.style.backgroundColor = 'green';
    } else {
        dot.style.transform = 'translateX(0)';
        dot.style.backgroundColor = 'white';
    }

    // Add event listener to handle checkbox state change
    toggle.addEventListener('change', function() {
        const productId = this.getAttribute('data-id'); // Get the category ID from the data-id attribute
        const newState = this.checked ? 1 : 0; // 1 for checked, 0 for unchecked

        // Toggle visual effect of the switch
        if (this.checked) {
            dot.style.transform = 'translateX(100%)';
            dot.style.backgroundColor = 'green';
        } else {
            dot.style.transform = 'translateX(0)';
            dot.style.backgroundColor = 'white';
        }

        // Send AJAX request to update the food item status
        fetch(`/admin/product/update-toggle/${productId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}', // CSRF token for security
            },
            body: JSON.stringify({
                state: newState, // The new state (1 or 0)
                type: 'status',  // Indicate we're updating the status
            }),
        })
        .then(response => response.json())
        .then(data => {
            if (!data.success) {
                // If update fails, reset the toggle state
                this.checked = !this.checked;
                dot.style.transform = this.checked ? 'translateX(100%)' : 'translateX(0)';
                dot.style.backgroundColor = this.checked ? 'green' : 'white';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            // Reset the toggle state in case of an error
            this.checked = !this.checked;
            dot.style.transform = this.checked ? 'translateX(100%)' : 'translateX(0)';
            dot.style.backgroundColor = this.checked ? 'green' : 'white';
        });
    });
});
</script>

<script>
    document.getElementById('search').addEventListener('input', function() {
        const searchQuery = this.value.toLowerCase();
        history.pushState(null, null, `?search=${searchQuery}`);
        filterTableByProductname(searchQuery);
    });


    function filterTableByProductname(query) {
        const rows = document.querySelectorAll('#productTable tbody tr');
        rows.forEach(row => {
            const cells = row.getElementsByTagName('td');
            const productnameCell = cells[5];

            if (productnameCell.textContent.toLowerCase().startsWith(query)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    window.addEventListener('popstate', function() {
        const urlParams = new URLSearchParams(window.location.search);
        const searchQuery = urlParams.get('search') || '';
        document.getElementById('search').value = searchQuery;
        filterTableByProductname(searchQuery);
    });
</script>

    <script>
    // Open the modal
    document.getElementById('openModalButton').addEventListener('click', function() {
        document.getElementById('productModal').classList.remove('modal-hidden');
        document.getElementById('productModal').classList.add('modal-visible'); // Show modal
        document.body.classList.add('overflow-hidden'); // Disable scrolling when modal is open
    });

    // Close the modal
    document.getElementById('closeModalButton').addEventListener('click', function() {
        document.getElementById('productModal').classList.remove('modal-visible');
        document.getElementById('productModal').classList.add('modal-hidden'); // Hide modal
        document.body.classList.remove('overflow-hidden'); // Re-enable scrolling
    });
    </script>
@endsection
