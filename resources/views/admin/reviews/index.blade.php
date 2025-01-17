@extends('layouts.admin')
@section('content')

<div class="p-4 bg-white shadow-lg -mt-12 mx-4 z-20  rounded-lg">

    <div class="mb-4 flex justify-between items-center">
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
        <table id="reviewTable" class="min-w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 px-4 py-2">S.N</th>
                    <th class="border border-gray-300 px-4 py-2">Image</th>
                    <th class="border border-gray-300 px-4 py-2">Product Name</th>
                    <th class="border border-gray-300 px-4 py-2">Name</th>
                    <th class="border border-gray-300 px-4 py-2">Message</th>
                    <th class="border border-gray-300 px-4 py-2">Status</th>
                    <th class="border border-gray-300 px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reviews as $review)
                    <tr class="border border-gray-300">
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ $loop->iteration }}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            <img src="{{ asset($review->product->image) }}" alt="{{ $review->product->name }}" class="w-16 h-16 object-cover rounded-lg">
                        </td>
                        <td class="border border-gray-300 px-4 py-2">{{ $review->product->name }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $review->user->name }} {{$review->user->last_name}}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $review->message }}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            <label for="status{{ $review->id }}" class="inline-flex items-center cursor-pointer">
                                <input id="status{{ $review->id }}" type="checkbox" class="hidden toggle-switch"
                                    data-id="{{ $review->id }}" {{ $review->status ? 'checked' : '' }} />

                                <div class="w-10 h-6 bg-gray-200 rounded-full relative">
                                    <div class="dot absolute left-1 top-1 w-4 h-4 bg-white rounded-full transition">
                                    </div>
                                </div>
                            </label>
                        </td>
                        <td class="flex justify-center py-4">
                            <!-- Delete Icon -->
                            <form action="{{route('admin.review.destroy',$review->id)}}" method="POST" onsubmit="return confirm('Are you sure you want to delete this review?');">
                                @csrf
                                @method('DELETE')
                                <button class="bg-red-500 hover:bg-red-700 mt-2 p-1 w-8 h-8 rounded-full flex items-center justify-center">
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
                Showing {{ $reviews->firstItem() }} to {{ $reviews->lastItem() }} of {{ $reviews->total() }} entries
            </span>
        </div>
    
        <div class="flex items-center space-x-2">
            {{ $reviews->links() }}
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
            const reviewId = this.getAttribute(
            'data-id'); // Get the review ID from the data-id attribute
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
            fetch(`/admin/review/update-toggle/${reviewId}`, {
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
    document.getElementById('search').addEventListener('input', function() {
        const searchQuery = this.value.toLowerCase();
        history.pushState(null, null, `?search=${searchQuery}`);
        filterTableByReviewname(searchQuery);
    });


    function filterTableByReviewname(query) {
        const rows = document.querySelectorAll('#reviewTable tbody tr');
        rows.forEach(row => {
            const cells = row.getElementsByTagName('td');
            const reviewnameCell = cells[2];

            if (reviewnameCell.textContent.toLowerCase().startsWith(query)) {
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
        filterTableByReviewname(searchQuery);
    });
</script>

@endsection
