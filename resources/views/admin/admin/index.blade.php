@extends('layouts.admin')

@section('content')

{{-- Flash Message --}}
@if(session('success'))
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

<div class="max-w-8xl mx-auto p-6 bg-white shadow-lg mt-[7rem] rounded-lg relative z-10">
    <div class="mb-4 flex justify-end">
        <button id="openModalButton" 
                class="text-red-500 font-medium bg-white border-2 border-red-500 rounded-lg py-2 px-4 hover:bg-red-600 hover:text-white transition duration-300">
            Add Admin
        </button>
    </div>
    
    <!-- Modal Structure -->
    <div id="adminModal" class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center hidden z-50 backdrop-blur-sm">
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
                    <button type="button" id="closeModalButton" 
                            class="w-full md:w-auto bg-gray-400 text-white py-2 px-4 rounded-lg hover:bg-gray-500 transition duration-300 focus:outline-none">
                        Close
                    </button>
    
                    <!-- Submit Button -->
                    <button type="submit" class="w-full md:w-auto bg-red-600 text-white font-semibold py-3 px-6 rounded-lg hover:bg-red-700 transition duration-300">
                        Create Admin
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
            <input type="text" id="search" placeholder="Search admins..."
                class="border border-gray-300 px-4 py-2 w-full sm:w-96" />
        </div>
    </div>

    <!-- Table Section -->
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border-collapse border border-gray-300 shadow-md rounded-lg">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 px-4 py-2 text-sm font-medium text-gray-600">S.N</th>
                    <th class="border border-gray-300 px-4 py-2 text-sm font-medium text-gray-600">Name</th>
                    <th class="border border-gray-300 px-4 py-2 text-sm font-medium text-gray-600">Email</th>
                    <th class="border border-gray-300 px-4 py-2 text-sm font-medium text-gray-600">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($admins as $admin)
                    <tr class="border border-gray-300 hover:bg-gray-50">
                        <td class="border border-gray-300 px-4 py-2 text-sm">{{ $loop->iteration }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-sm">{{ $admin->name }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-sm">{{ $admin->email }}</td>

                        <!-- Action Buttons -->
                        <td class="px-2 py-2 flex justify-center space-x-4">
                            <!-- Edit Icon -->
                            <a href="{{ route('admin.admin.edit', ['user' => $admin->id]) }}"
                               class="bg-blue-500 hover:bg-blue-700 p-2 w-10 h-10 rounded-full flex items-center justify-center">
                                <i class="ri-edit-box-line text-white"></i>
                            </a>

                            <!-- Delete Icon -->
                            <form action="{{ route('admin.admin.destroy', ['user' => $admin->id]) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this admin?');">
                                @csrf
                                @method('delete')
                                <button class="bg-red-500 hover:bg-red-700 p-2 w-10 h-10 rounded-full flex items-center justify-center">
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
    // Open the modal
    document.getElementById('openModalButton').addEventListener('click', function () {
        document.getElementById('adminModal').classList.remove('hidden');
        document.body.classList.add('overflow-hidden'); // Disable scrolling when modal is open
    });

    // Close the modal using the close button inside the form
    document.getElementById('closeModalButton').addEventListener('click', function () {
        document.getElementById('adminModal').classList.add('hidden');
        document.body.classList.remove('overflow-hidden'); // Re-enable scrolling
    });
</script>
@endsection
