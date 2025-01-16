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
        <div class="mb-4 flex justify-end gap-3">
            <button id="openModalButton"
                class="text-blue-500 font-medium bg-white border-2 border-blue-500 rounded-lg py-2 px-4 hover:bg-blue-600 hover:text-white transition duration-300">
                Add Newsletter
            </button>
            <a href="{{ route('admin.newsletter.subscribers') }}"
                class="text-blue-500 font-medium bg-white border-2 border-blue-500 rounded-lg py-2 px-4 hover:bg-blue-600 hover:text-white transition duration-300">
                View Subscribers
            </a>
        </div>

        <!-- Modal Structure -->
        <div id="newsletterModal"
            class="fixed inset-0 bg-black bg-opacity-70 modal-hidden items-center justify-center z-50 backdrop-blur-[1px]">
            <div class="bg-white rounded-lg p-8 w-full max-w-lg relative shadow-xl">
                <h2 class="text-2xl font-semibold text-gray-900 mb-4">Send Newsletter</h2>
                <form method="POST" action="{{route('admin.newsletter.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="subject" class="block text-sm font-medium text-gray-700">Subject</label>
                        <input type="text" id="subject" name="subject"
                            class="mt-1 block w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                    </div>
                    
                    <div class="mb-4">
                        <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
                        <textarea id="content" name="content"
                            class="mt-1 block w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            rows="6" required></textarea>
                    </div>
                    
                    <div class="mb-4">
                        <label for="attachment" class="block text-sm font-medium text-gray-700">Attachment</label>
                        <input type="file" id="attachment" name="attachment"
                            class="mt-1 block w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            accept="image/*">
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
                                class="w-full md:w-auto bg-gradient-to-r from-indigo-600 to-indigo-700 text-white font-semibold py-2 px-4 ml-[17rem] rounded-lg hover:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-300 transform hover:scale-105">
                                Submit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="mb-4 flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <label for="entries" class="mr-2">Show entries:</label>
                <select id="entries" class="border border-gray-300 px-5 py-1 w-full sm:w-auto pr-10"
                    onchange="updateEntries()">
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
                        <th class="border border-gray-300 px-4 py-2">S.N</th>
                        <th class="border border-gray-300 px-4 py-2">Subject</th>
                        <th class="border border-gray-300 px-4 py-2">Message</th>
                        <th class="border border-gray-300 px-4 py-2">Attachment</th>
                        <th class="border border-gray-300 px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($newsletters as $newsletter)
                        <tr class="border border-gray-300">
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $loop->iteration }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $newsletter->subject }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $newsletter->content }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center align-middle">
                                @if ($newsletter->attachment)
                                    <img src="{{ asset('attachment/'. $newsletter->attachment) }}" alt="Attachment Image" class="rounded" style="max-width: 100%; max-height: 150px; height: auto; display: block; margin: 0 auto;">
                                @else
                                    No Attachment
                                @endif
                            </td>
                            
                            
                            <td class="flex justify-center py-4">

                                <!-- Send Message Icon -->
                                <form action="{{ route('admin.newsletter.send.post', $newsletter->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" 
                                            class="bg-green-500 hover:bg-green-700 mt-2 p-1 w-8 h-8 rounded-full flex items-center justify-center mr-2">
                                        <i class="ri-send-plane-line text-white"></i>
                                    </button>
                                </form>
                                
                                <!-- Edit Icon -->
                                <a href="{{route('admin.newsletter.edit', $newsletter->id)}}"
                                    class="bg-blue-500 hover:bg-blue-700 mt-2 p-1 w-8 h-8 rounded-full flex items-center justify-center mr-2">
                                    <i class="ri-edit-line text-white"></i>
                                </a>


                                <!-- Delete Icon -->
                                <form action="{{ route('admin.newsletter.destroynewsletter', $newsletter->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this newsletter?');">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        class="bg-red-500 hover:bg-red-700 mt-2 p-1 w-8 h-8 rounded-full flex items-center justify-center">
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
                    Showing {{ $newsletters->firstItem() }} to {{ $newsletters->lastItem() }} of
                    {{ $newsletters->total() }} entries
                </span>
            </div>

            <div class="flex items-center space-x-2">
                {{ $newsletters->links() }}
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
    </script>

    <script>
        // Open the modal
        document.getElementById('openModalButton').addEventListener('click', function() {
            document.getElementById('newsletterModal').classList.remove('modal-hidden');
            document.getElementById('newsletterModal').classList.add('modal-visible'); // Show modal
            document.body.classList.add('overflow-hidden'); // Disable scrolling when modal is open
        });

        // Close the modal
        document.getElementById('closeModalButton').addEventListener('click', function() {
            document.getElementById('newsletterModal').classList.remove('modal-visible');
            document.getElementById('newsletterModal').classList.add('modal-hidden'); // Hide modal
            document.body.classList.remove('overflow-hidden'); // Re-enable scrolling
        });
    </script>
@endsection
