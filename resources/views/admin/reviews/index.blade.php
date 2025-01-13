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
    </div>
    

    <!-- Table Section -->
    <div class="overflow-x-auto">
        <table class="min-w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 px-4 py-2">S.N</th>
                    <th class="border border-gray-300 px-4 py-2">Image</th>
                    <th class="border border-gray-300 px-4 py-2">Product Name</th>
                    <th class="border border-gray-300 px-4 py-2">Email</th>
                    <th class="border border-gray-300 px-4 py-2">Message</th>
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
                        <td class="border border-gray-300 px-4 py-2">{{ $review->email }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $review->message }}</td>
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

@endsection
