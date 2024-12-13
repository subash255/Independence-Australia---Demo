@extends('layouts.admin')

@section('content')

<!-- Flash Messages (if any) -->
@if(session('success'))
    <div id="flash-message" class="bg-green-500 text-white px-6 py-2 rounded-lg fixed top-4 right-4 shadow-lg z-50">
        {{ session('success') }}
    </div>
@endif

<script>
  if (document.getElementById('flash-message')) {
      setTimeout(() => { 
          const msg = document.getElementById('flash-message'); 
          msg.style.opacity = 0; 
          msg.style.transition = "opacity 0.5s ease-out"; 
          setTimeout(() => msg.remove(), 500); 
      }, 3000);
  }
</script>

<div class="max-w-8xl mx-auto p-4 bg-white shadow-lg mt-[7rem] rounded-lg relative z-10">
    <div class="mb-4 flex justify-end">
        <a href="{{ route('admin.subcategory.create') }}" class="text-red-500 font-medium bg-white border-2 border-red-500 rounded-lg py-2 px-4 hover:bg-red-600 hover:text-white transition duration-300">Add Subcategory</a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full border-collapse border border-gray-300">
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
                        <td class="border border-gray-300 px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            <img src="{{ asset('images/brand/' . $subcategory->category->image) }}" alt="{{ $subcategory->category->category_name }}" class="w-12 h-12 object-cover rounded-full">
                        </td>
                        <td class="border border-gray-300 px-4 py-2">{{ $subcategory->category->category_name }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $subcategory->subcategory_name }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $subcategory->slug }}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            <label for="status{{ $subcategory->id }}" class="inline-flex items-center cursor-pointer">
                                <input id="status{{ $subcategory->id }}" type="checkbox" class="hidden toggle-switch" data-id="{{ $subcategory->id }}" {{ $subcategory->status ? 'checked' : '' }} />
                                <div class="w-10 h-6 bg-gray-200 rounded-full relative">
                                    <div class="dot absolute left-1 top-1 w-4 h-4 bg-white rounded-full transition"></div>
                                </div>
                            </label>
                        </td>
                        <td class="px-2 py-2 mt-2 flex justify-center space-x-4">
                            <!-- Edit Icon -->
                            <a href="{{ route('admin.subcategory.edit', ['id' => $subcategory->id]) }}" class="bg-blue-500 hover:bg-blue-700 p-2 w-10 h-10 rounded-full flex items-center justify-center">
                                <i class="ri-edit-box-line text-white"></i>
                            </a>
                            <!-- Delete Icon -->
                            <form action="{{ route('admin.subcategory.destroy', ['id' => $subcategory->id]) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this subcategory?');">
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
    document.querySelectorAll('.toggle-switch').forEach(toggle => {

        const dot = toggle.parentNode.querySelector('.dot');
  
  // Apply the correct initial state
  if (toggle.checked) {
    dot.style.transform = 'translateX(100%)';
    dot.style.backgroundColor = 'green';
  } else {
    dot.style.transform = 'translateX(0)';
    dot.style.backgroundColor = 'white';
  }
        toggle.addEventListener('change', function () {
            const subcategoryId = this.getAttribute('data-id');
            const newState = this.checked ? 1 : 0;

            // Toggle visual effect
            if (this.checked) {
                dot.style.transform = 'translateX(100%)';
                dot.style.backgroundColor = 'green';
            } else {
                dot.style.transform = 'translateX(0)';
                dot.style.backgroundColor = 'white';
            }

            // Send AJAX request to update the subcategory status
            fetch(`/admin/subcategory/update-toggle/${subcategoryId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}', // CSRF token for security
                },
                body: JSON.stringify({
                    state: newState
                }),
            })
            .then(response => response.json())
            .then(data => {
                if (!data.success) {
                    // If update fails, reset toggle state
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

@endsection
