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
                Add Text
            </button>
        </div>

        <!-- Modal Structure for Create Text -->
        <div id="textModal"
            class="fixed inset-0 bg-black bg-opacity-70 modal-hidden items-center justify-center z-50 backdrop-blur-[1px]">
            <div class="bg-white rounded-lg p-6 w-full max-w-lg relative">
                <h2 class="text-xl font-semibold text-center">Create New Text</h2>
                <form action="{{ route('admin.text.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Text Image Input -->
                    <div class="mb-6">
                        <label for="text" class="block text-sm font-medium text-gray-700">Text Content</label>
                        <textarea id="text" name="text" rows="4" placeholder="Enter text here"
                            class="mt-2 px-5 py-3 w-full border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none transition duration-300 hover:border-indigo-400 text-lg"></textarea>
                    </div>

                    <!-- Priority Input -->
                    <div class="mb-6">
                        <label for="priority" class="block text-sm font-medium text-gray-700">Priority</label>
                        <select id="priority" name="priority"
                            class="mt-2 px-5 py-3 w-full border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none transition duration-300 hover:border-indigo-400 text-lg">
                            <option value="" disabled>Select priority</option>
                            @foreach ($availablePriorities as $priority)
                                <option value="{{ $priority }}" {{ old('priority') == $priority ? 'selected' : '' }}>
                                    {{ $priority }}
                                </option>
                            @endforeach
                        </select>
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
                            Save Text
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
        </div>

        <!-- Table Section -->
        <div class="overflow-x-auto">
            <table class="min-w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border border-gray-300 px-4 py-2">Priority</th>
                        <th class="border border-gray-300 px-4 py-2">Text</th>
                        <th class="border border-gray-300 px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($texts as $text)
                        <tr class="border border-gray-300">
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $text->priority }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $text->text }}
                            </td>
                            <td class="px-2 py-2 mt-2 flex justify-center space-x-4">
                                <!-- Edit Icon -->
                                <a href="{{ route('admin.text.edit', $text->id) }}"
                                    class="bg-blue-500 hover:bg-blue-700 p-1 w-8 h-8 rounded-full flex items-center justify-center">
                                    <i class="ri-edit-box-line text-white"></i>
                                </a>
                                <!-- Delete Icon -->
                                <form action="{{ route('admin.text.destroy', $text->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this Text?');">
                                    @csrf
                                    @method('DELETE')
                                    <button
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

        <!-- Pagination Section -->
        <div class="flex justify-between items-center mt-4">
            <div class="flex items-center space-x-2">
                <span class="ml-4 text-gray-700">
                    Showing {{ $texts->firstItem() }} to {{ $texts->lastItem() }} of {{ $texts->total() }} entries
                </span>
            </div>

            <div class="flex items-center space-x-2">
                {{ $texts->links() }}
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
    
        // Open the modal
        document.getElementById('openModalButton').addEventListener('click', function() {
            document.getElementById('textModal').classList.remove('modal-hidden');
            document.getElementById('textModal').classList.add('modal-visible'); // Show modal
            document.body.classList.add('overflow-hidden'); // Disable scrolling when modal is open
        });

        // Close the modal
        document.getElementById('closeModalButton').addEventListener('click', function() {
            document.getElementById('textModal').classList.remove('modal-visible');
            document.getElementById('textModal').classList.add('modal-hidden'); // Hide modal
            document.body.classList.remove('overflow-hidden'); // Re-enable scrolling
        });
    </script>
@endsection
