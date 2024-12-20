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

<div class="max-w-8xl mx-auto p-4 bg-white shadow-lg mt-[7rem] rounded-lg relative z-10">
    <!-- Button to Open Modal -->
<div class="mb-4 flex justify-end">
    <button id="openBrandModalButton" 
    class="text-red-500 font-medium bg-white border-2 border-red-500 rounded-lg py-2 px-4 hover:bg-red-600 hover:text-white transition duration-300">
    Add Brand
    </button>
</div>

<!-- Modal Structure -->
<div id="brandModal" class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center hidden z-50 backdrop-blur-[1px]">
    <div class="bg-white rounded-lg p-8 w-full max-w-lg relative shadow-2xl transform transition-all duration-300 scale-95">
        <h2 class="text-3xl font-semibold text-center text-gray-900 mb-6">Create Brand</h2>

        <form action="{{ route('brand.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Brand Name Field -->
            <div class="mb-6">
                <label for="name" class="block text-sm font-medium text-gray-700">Brand Name</label>
                <input type="text" name="name" id="name" class="mt-2 block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-lg placeholder-gray-500" placeholder="Enter brand name" required>
            </div>

            <!-- Brand Image Field -->
            <div class="mb-6">
                <label for="image" class="block text-sm font-medium text-gray-700">Upload Image</label>
                <input type="file" id="image" name="image" accept="image/*" required
                    class="mt-2 px-5 py-3 w-full border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none transition duration-300 hover:border-indigo-400 text-lg">
            </div>

            <!-- Button Container -->
            <div class="flex justify-between gap-4 mt-8">
                <!-- Close Button -->
                <button type="button" id="closeBrandModalButton" 
                        class="w-full md:w-auto bg-gray-400 text-white py-3 px-6 rounded-lg hover:bg-gray-500 transition duration-300 focus:outline-none">
                    Close
                </button>

                <!-- Submit Button -->
                <button type="submit" class="w-full md:w-auto bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-300 transform hover:scale-105">
                    Create Brand
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
        <table class="min-w-full border-collapse border border-gray-300">
            <thead>
                <tr>
                    <th class="border border-gray-300 px-4 py-2">S.N</th>
                    <th class="border border-gray-300 px-4 py-2">Image</th>
                    <th class="border border-gray-300 px-4 py-2">Brand Name</th>
                    <th class="border border-gray-300 px-4 py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($brands as $brand)
                    <tr class="border border-gray-300">
                        <td class="border border-gray-300 px-4 py-2">{{ $loop->iteration }}</td>

                        <!-- Displaying the Image -->
                        <td class="border border-gray-300 px-4 py-2">
                            <img src="{{ asset('images/brands/' . $brand->image) }}"
                                alt="{{ $brand->name }}" class="w-12 h-12 object-cover rounded-full">
                        </td>

                        <td class="border border-gray-300 px-4 py-2">{{ $brand->name }}</td>
                       
                        <td class="px-2 py-2 mt-2 flex justify-center space-x-4">
                            <!-- Edit Icon -->
                            <a href="{{ route('admin.brand.edit', ['id' => $brand->id]) }}" class="bg-blue-500 hover:bg-blue-700 p-2 w-10 h-10 rounded-full flex items-center justify-center">
                                <i class="ri-edit-box-line text-white"></i>
                            </a>
                            <!-- Delete Icon -->
                            <form action="{{ route('admin.brand.destroy', $brand->id) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this category?');">
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
                Showing {{ $brands->firstItem() }} to {{ $brands->lastItem() }} of {{ $brands->total() }}
                entries
            </span>
        </div>

        <div class="flex items-center space-x-2">
            {{ $brands->links() }}
        </div>
    </div>

</div>

<script>
    // Open the modal when "Add Brand" button is clicked
    document.getElementById('openBrandModalButton').addEventListener('click', function () {
        document.getElementById('brandModal').classList.remove('hidden');
        document.body.classList.add('overflow-hidden'); // Disable scrolling when modal is open
    });

    // Close the modal when the close button is clicked
    document.getElementById('closeBrandModalButton').addEventListener('click', function () {
        document.getElementById('brandModal').classList.add('hidden');
        document.body.classList.remove('overflow-hidden'); // Re-enable scrolling
    });
</script>

@endsection
