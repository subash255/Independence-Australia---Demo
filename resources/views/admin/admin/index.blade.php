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

<div class="p-4 bg-white shadow-lg -mt-12 mx-4 z-20  rounded-lg">

    <div class="mb-4 flex justify-end">
        <button id="openModalButton" 
                class="text-blue-500 font-medium bg-white border-2 border-blue-500 rounded-lg py-2 px-4 hover:bg-blue-600 hover:text-white transition duration-300">
            Add Admin
        </button>
    </div>
    
    <!-- Modal Structure -->
    <div id="adminModal" class="fixed inset-0 bg-black bg-opacity-70 modal-hidden items-center justify-center z-50 backdrop-blur-[1px]">
        <div class="bg-white rounded-lg p-8 w-full max-w-lg relative shadow-xl">
            <h2 class="text-2xl font-semibold text-center text-gray-900 mb-8">Add Admin</h2>
    
            <form method="POST" action="{{ route('admin.store') }}" class="space-y-6">
                @csrf
    
                <!-- Name Field -->
                <div class="flex flex-col">
                    <label for="name" class="text-lg text-gray-700">Name</label>
                    <input type="text" name="name" id="name" class="mt-2 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                </div>
    
                <!-- Email Field -->
                <div class="flex flex-col">
                    <label for="email" class="text-lg text-gray-700">Email</label>
                    <input type="email" name="email" id="email" class="mt-2 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                </div>
    
                <!-- Password Field -->
                <div class="flex flex-col">
                    <label for="password" class="text-lg text-gray-700">Password</label>
                    <input type="password" name="password" id="password" class="mt-2 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                </div>
    
                <!-- Confirm Password Field -->
                <div class="flex flex-col">
                    <label for="password_confirmation" class="text-lg text-gray-700">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="mt-2 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                </div>
    
                <!-- Button Container -->
                <div class="flex justify-between gap-4 mt-8">
                    <!-- Close Button -->
                    <div class="flex justify-between gap-4 mt-8">
                        <!-- Close Button -->
                        <button type="button" id="closeModalButton"
                        class="w-full md:w-auto bg-red-500 text-white py-2 px-4 font-semibold rounded-lg hover:bg-red-600 transition duration-300 focus:outline-none">
                        Cancel
                    </button>
    
                        <!-- Submit Button -->
                        <button type="submit"
                            class="w-full md:w-auto bg-gradient-to-r from-indigo-600 to-indigo-700 text-white font-semibold py-2 px-4 ml-[13rem] rounded-lg hover:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-300 transform hover:scale-105">
                            Create Admin
                        </button>
                    </div>
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
            <input type="text" id="search" placeholder="Search admins..."
                class="border border-gray-300 px-4 py-2 w-full sm:w-96" />
        </div>
    </div>

    <!-- Table Section -->
    <div class="overflow-x-auto">
        <table id="adminTable" class="min-w-full bg-white border-collapse border border-gray-300 shadow-md rounded-lg">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 px-4 py-2  ">S.N</th>
                    <th class="border border-gray-300 px-4 py-2  ">Name</th>
                    <th class="border border-gray-300 px-4 py-2  ">Email</th>
                    <th class="border border-gray-300 px-4 py-2  ">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($admins as $admin)
                    <tr class="border border-gray-300 hover:bg-gray-50">
                        <td class="border border-gray-300 px-4 py-2 text-sm text-center">{{ $loop->iteration }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-sm">{{ $admin->name }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-sm">{{ $admin->email }}</td>

                        <!-- Action Buttons -->
                        <td class="px-2 py-2 flex justify-center space-x-4">
                            <!-- Edit Icon -->
                            <a href="{{ route('admin.admin.edit', ['user' => $admin->id]) }}"
                               class="bg-blue-500 hover:bg-blue-700 p-1 w-8 h-8 rounded-full flex items-center justify-center">
                                <i class="ri-edit-box-line text-white"></i>
                            </a>

                            <!-- Delete Icon -->
                            <form action="{{ route('admin.admin.destroy', ['user' => $admin->id]) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this admin?');">
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

    <!-- Pagination and Show Entries Section at the Bottom -->
    <div class="flex justify-between items-center mt-4">
        <div class="flex items-center space-x-2">
            <span class="ml-4 text-gray-700">
                Showing {{ $admins->firstItem() }} to {{ $admins->lastItem() }} of {{ $admins->total() }}
                entries
            </span>
        </div>

        <div class="flex items-center space-x-2">
            {{ $admins->links() }}
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
    // Get the dropdown and table
    const entriesDropdown = document.getElementById('entries');
    const dataTable = document.getElementById('dataTable');
    const rows = dataTable.getElementsByTagName('tr'); // Get all rows in the table

    // Function to filter the table rows based on selected number of entries
    function filterTable() {
        const entriesToShow = parseInt(entriesDropdown.value); // Get the selected number of entries
        let rowCount = 0;

        // Loop through all rows (starting from index 1 to skip the header row)
        for (let i = 1; i < rows.length; i++) {
            if (rowCount < entriesToShow) {
                rows[i].style.display = ''; // Show the row
                rowCount++;
            } else {
                rows[i].style.display = 'none'; // Hide the row
            }
        }
    }

    // Add event listener to the dropdown to trigger filterTable on change
    entriesDropdown.addEventListener('change', filterTable);

    // Call filterTable initially to set the default view (5 entries)
    filterTable();
</script>

<script>
    document.getElementById('search').addEventListener('input', function() {
        const searchQuery = this.value.toLowerCase();
        history.pushState(null, null, `?search=${searchQuery}`);
        filterTableByAdminname(searchQuery);
    });


    function filterTableByAdminname(query) {
        const rows = document.querySelectorAll('#adminTable tbody tr');
        rows.forEach(row => {
            const cells = row.getElementsByTagName('td');
            const adminnameCell = cells[2];

            if (adminnameCell.textContent.toLowerCase().startsWith(query)) {
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
        filterTableByAdminname(searchQuery);
    });
</script>

<script>
    // Open the modal
    document.getElementById('openModalButton').addEventListener('click', function() {
        document.getElementById('adminModal').classList.remove('modal-hidden');
        document.getElementById('adminModal').classList.add('modal-visible'); // Show modal
        document.body.classList.add('overflow-hidden'); // Disable scrolling when modal is open
    });

    // Close the modal
    document.getElementById('closeModalButton').addEventListener('click', function() {
        document.getElementById('adminModal').classList.remove('modal-visible');
        document.getElementById('adminModal').classList.add('modal-hidden'); // Hide modal
        document.body.classList.remove('overflow-hidden'); // Re-enable scrolling
    });
</script>
@endsection
