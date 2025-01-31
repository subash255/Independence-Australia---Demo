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

<div class="p-4 bg-white shadow-lg -mt-12 mx-4 z-20 rounded-lg">
    <div class="mb-4 flex justify-end">
        <button id="openModalButton"
            class="text-blue-500 font-medium bg-white border-2 border-blue-500 rounded-lg py-2 px-4 hover:bg-blue-600 hover:text-white transition duration-300">
            Add Subcategory
        </button>
    </div>

    <!-- Modal Structure -->
    <div id="subcategoryModal" class="fixed inset-0 bg-black bg-opacity-70 modal-hidden items-center justify-center z-50 backdrop-blur-[1px]">
        <div class="bg-white rounded-lg p-6 w-full max-w-lg relative shadow-xl overflow-auto max-h-[90vh]">
            <h2 class="text-2xl font-semibold text-center text-gray-900 mb-8">Add Subcategory</h2>

            <form action="{{ route('admin.subcategory.store') }}" method="POST">
                @csrf

                <!-- Category Selection -->
                <div class="mb-6">
                    <label for="category" class="block text-sm font-medium text-gray-700">
                        {{ $subcategories->first() ? $subcategories->first()->category->name : 'No category available' }}
                    </label>
                </div>

                <!-- Subcategory Name Input -->
                <div class="mb-6">
                    <label for="subcategory_name" class="block text-sm font-medium text-gray-700">Subcategory Name</label>
                    <input type="text" name="subcategory_name" id="subcategory_name"
                        class="mt-2 px-4 py-3 w-full border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none transition duration-300 hover:border-indigo-400 text-lg"
                        required oninput="generateSlug()" />
                </div>

                <!-- Slug Input (auto-generated) -->
                <div class="mb-6">
                    <label for="slug" class="block text-sm font-medium text-gray-700">Slug</label>
                    <input type="text" name="slug" id="slug" placeholder="Generated slug"
                        class="mt-2 px-4 py-3 w-full border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none transition duration-300 hover:border-indigo-400 text-lg"
                        readonly required>
                </div>

                <!-- Description -->
                <div class="mb-6">
                    <label for="paragraph" class="block text-sm font-medium text-gray-700">Description (Optional)</label>
                    <textarea name="paragraph" id="paragraph"
                        class="mt-2 px-4 py-3 w-full border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none transition duration-300 hover:border-indigo-400 text-lg"
                        rows="4"></textarea>
                </div>

                <!-- Button Container -->
                <div class="flex justify-between gap-4 mt-8">
                    <!-- Close Button -->
                    <button type="button" id="closeModalButton"
                        class="w-full md:w-auto bg-red-500 font-semibold text-white py-2 px-4 rounded-lg hover:bg-red-600 transition duration-300 focus:outline-none">
                        Cancel
                    </button>

                    <!-- Submit Button -->
                    <button type="submit"
                        class="w-full md:w-auto bg-gradient-to-r from-indigo-600 to-indigo-700 text-white font-semibold py-2 px-6 rounded-lg hover:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-300 transform hover:scale-105">
                        Save Subcategory
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="flex flex-col sm:flex-row justify-between mb-4 gap-4">
        <div class="flex items-center space-x-2">
            <label for="entries" class="mr-2">Show entries:</label>
            <select id="entries" class="border border-gray-300 px-5 py-1 w-full sm:w-auto pr-10" onchange="updateEntries()">
                <option value="5" {{ request('entries') == 5 ? 'selected' : '' }}>5</option>
                <option value="15" {{ request('entries') == 15 ? 'selected' : '' }}>15</option>
                <option value="25" {{ request('entries') == 25 ? 'selected' : '' }}>25</option>
            </select>
        </div>

        <div class="flex items-center space-x-2 w-full sm:w-auto">
            <span class="text-gray-700">Search:</span>
            <input type="text" id="search" placeholder="Search..."
                class="border border-gray-300 px-4 py-2 w-full sm:w-96" />
        </div>
    </div>

    <!-- Table Section -->
    <div class="overflow-x-auto">
        <table id="subcategoryTable" class="min-w-full border-collapse border border-gray-300">
            <thead>
                <tr>
                    <th class="border border-gray-300 px-4 py-2">Order</th>
                    <th class="border border-gray-300 px-4 py-2">Image</th>
                    <th class="border border-gray-300 px-4 py-2">Category Name</th>
                    <th class="border border-gray-300 px-4 py-2">Subcategory Name</th>
                    <th class="border border-gray-300 px-4 py-2">Slug</th>
                    <th class="border border-gray-300 px-4 py-2">Status</th>
                    <th class="border border-gray-300 px-4 py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($subcategories as $subcategory)
                <tr class="border border-gray-300">
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $loop->iteration }}</td>
                    <td class="border border-gray-300 px-4 py-2">
                        <img src="{{ asset('images/brand/' . $subcategory->category->image) }}" alt="{{ $subcategory->category->category_name }}" class="w-12 h-12 object-cover rounded-full">
                    </td>
                    <td class="border border-gray-300 px-4 py-2">{{ $subcategory->category->name }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $subcategory->name }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $subcategory->slug }}</td>
                    <td class="border border-gray-300 px-4 py-2">
                        <label for="status{{ $subcategory->id }}" class="inline-flex items-center cursor-pointer">
                            <input id="status{{ $subcategory->id }}" type="checkbox" class="hidden toggle-switch"
                                data-id="{{ $subcategory->id }}" {{ $subcategory->status ? 'checked' : '' }} />

                            <div class="w-10 h-6 bg-gray-200 rounded-full relative">
                                <div class="dot absolute left-1 top-1 w-4 h-4 bg-white rounded-full transition">
                                </div>
                            </div>
                        </label>
                    </td>
                    <td class="px-2 py-2 mt-2 flex justify-center space-x-4">
                        <!-- Edit Icon -->
                        <a href="{{ route('admin.subcategory.edit',  ['slug' => $subcategory->slug]) }}" class="bg-blue-500 hover:bg-blue-700 p-1 w-8 h-8 rounded-full flex items-center justify-center">
                            <i class="ri-edit-box-line text-white"></i>
                        </a>
                        <!-- Delete Icon -->
                        <form action="{{ route('admin.subcategory.destroy', ['id' => $subcategory->id]) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this subcategory?');">
                            @csrf
                            @method('delete')
                            <button class="bg-red-500 hover:bg-red-700 p-1 w-8 h-8 rounded-full flex items-center justify-center">
                                <i class="ri-delete-bin-line text-white"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination Section -->
    <div class="flex justify-between items-center mt-4">
        <div class="flex items-center space-x-2">
            <span class="ml-4 text-gray-700">
                Showing {{ $subcategories->firstItem() }} to {{ $subcategories->lastItem() }} of {{ $subcategories->total() }} entries
            </span>
        </div>
        <div class="flex items-center space-x-2">
            {{ $subcategories->links() }}
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
            const subcategoryId = this.getAttribute(
            'data-id'); // Get the subcategory ID from the data-id attribute
            const newState = this.checked ? 1 : 0; // 1 for checked, 0 for unchecked

            // Toggle visual effect of the switch
            if (this.checked) {
                dot.style.transform = 'translateX(100%)';
                dot.style.backgroundColor = 'green';
            } else {
                dot.style.transform = 'translateX(0)';
                dot.style.backgroundColor = 'white';
            }

            // Send AJAX request to update the status
            fetch(`/admin/subcategory/update-toggle/${subcategoryId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}', // CSRF token for security
                    },
                    body: JSON.stringify({
                        state: newState, // The new state (1 or 0)
                        type: 'status', // Indicate we're updating the status
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

// function updateEntries() {
//         const entries = document.getElementById('entries').value;
//         const url = new URL(window.location.href);
//         url.searchParams.set('entries', entries); 
//         window.location.href = url; 
//     }
    
    document.getElementById('search').addEventListener('input', function() {
        const searchQuery = this.value.toLowerCase();
        history.pushState(null, null, `?search=${searchQuery}`);
        filterTableBySubcategoryname(searchQuery);
    });


    function filterTableBySubcategoryname(query) {
        const rows = document.querySelectorAll('#subcategoryTable tbody tr');
        rows.forEach(row => {
            const cells = row.getElementsByTagName('td');
            const subcategorynameCell = cells[4];

            if (subcategorynameCell.textContent.toLowerCase().startsWith(query)) {
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
        filterTableBySubcategoryname(searchQuery);
    });
</script>

<script>
    // Function to generate slug from subcategory name
    function generateSlug() {
        let input1 = document.getElementById('subcategory_name').value;
        let slug = input1.trim().replace(/\s+/g, '-').toLowerCase();
        document.getElementById('slug').value = slug;
    }

    // Open the modal
    document.getElementById('openModalButton').addEventListener('click', function() {
        document.getElementById('subcategoryModal').classList.remove('modal-hidden');
        document.getElementById('subcategoryModal').classList.add('modal-visible'); // Show modal
        document.body.classList.add('overflow-hidden'); // Disable scrolling when modal is open
    });

    // Close the modal
    document.getElementById('closeModalButton').addEventListener('click', function() {
        document.getElementById('subcategoryModal').classList.remove('modal-visible');
        document.getElementById('subcategoryModal').classList.add('modal-hidden'); // Hide modal
        document.body.classList.remove('overflow-hidden'); // Re-enable scrolling
    });
</script>

@endsection