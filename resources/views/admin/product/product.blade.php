@extends('layouts.admin')

@section('content')

{{-- Flash Message --}}
@if(session('success'))
    <div id="flash-message" class="bg-green-500 text-white px-6 py-2 rounded-lg fixed top-4 right-4 shadow-lg z-50">
        {{ session('success') }}
    </div>
@endif


<!-- Main container -->
<div class="max-w-full mx-auto p-4 bg-white shadow-lg mt-[7rem] rounded-lg relative z-10">
  <div class="mb-4 flex justify-end space-x-4">
    <div class="mr-[28rem] mt-2">
      <a href="{{ route('admin.product.addproduct') }}" class="text-red-500 font-medium bg-white border-2 border-red-500 rounded-lg py-2 px-4 hover:bg-red-600 hover:text-white transition duration-300">Add product</a>
    </div>
    <button class="bg-white border-2 border-blue-700 text-gray-900 px-4 py-2 rounded-md hover:bg-blue-700 hover:text-white">Pending</button>
    <button class="bg-white border-2 border-green-600 text-gray-900 px-4 py-2 rounded-md hover:bg-green-600 hover:text-white">Approved</button>
    <button class="bg-white border-2 border-red-600 text-gray-900 px-4 py-2 rounded-md hover:bg-red-600 hover:text-white">Rejected</button>
  </div>

  <div class="flex justify-between mb-4">
    <!-- Left: Show entries with tag above -->
    <div>
      <label for="entries" class="mr-2">Show entries:</label>
      <select id="entries" class="border border-gray-300 px-2 py-1">
        <option value="5">5</option>
        <option value="10">10</option>
        <option value="15">15</option>
      </select>
    </div>

    <!-- Right: Search with label beside -->
    <div class="flex items-center space-x-2">
      <span class="text-gray-700">Search:</span>
      <input type="text" id="search" placeholder="Search..." class="border border-gray-300 px-4 py-2 w-96" />
    </div>
  </div>

  <!-- Table Container with horizontal scroll if needed -->
  <div class="overflow-x-auto">
    <table class="min-w-full border-collapse border border-gray-300 table-auto">
      <thead>
        <tr>
          <th class="border border-gray-300 px-2 py-2 font-medium">S.N</th>
          <th class="border border-gray-300 px-2 py-2 font-medium">Photo</th>
          <th class="border border-gray-300 px-2 py-2 font-medium">Category Name</th>
          <th class="border border-gray-300 px-2 py-2 font-medium">Subcategory Name</th>
          <th class="border border-gray-300 px-7 py-2 font-medium">Product Name</th>
          <th class="border border-gray-300 px-2 py-2 font-medium">Visibility</th>
          <th class="border border-gray-300 px-2 py-2 font-medium">Is Flash</th>
          <th class="border border-gray-300 px-2 py-2 font-medium">Status</th>
          <th class="border border-gray-300 px-2 py-2 font-medium">Remarks</th>
          <th class="border border-gray-300 px-2 py-2 font-medium">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($products as $product)
        <tr>
          <td class="border border-gray-300 px-4 py-2">{{ $loop->iteration }}</td>
          <td class="border border-gray-300 px-4 py-2">
            <img src="{{ asset('products/' . $product->image) }}" alt="{{ $product->product_name }}" class="w-16 h-16 object-cover rounded-full" />
          </td>
          <td class="border border-gray-300 px-4 py-2">
            {{ $product->category ? $product->category->category_name : 'No Category' }}
          </td>
          <td class="border border-gray-300 px-4 py-2">
            {{ $product->subcategory ? $product->subcategory->subcategory_name : 'No Subcategory' }}
          </td>
          <td class="border border-gray-300 px-4 py-2">{{ $product->product_name }}</td>
          <td class="border border-gray-300 px-4 py-2">
            <label for="status{{ $product->id }}" class="inline-flex items-center cursor-pointer">
              <input id="status{{ $product->id }}" type="checkbox" class="hidden toggle-switch" data-id="{{ $product->id }}" {{ $product->visibility ? 'checked' : '' }} />
              <div class="w-10 h-6 bg-gray-200 rounded-full relative">
                <div class="dot absolute left-1 top-1 w-4 h-4 bg-white rounded-full transition"></div>
              </div>
            </label>
          </td>
          <td class="border border-gray-300 px-4 py-2">
            <label for="flash{{ $product->id }}" class="inline-flex items-center cursor-pointer">
              <input id="flash{{ $product->id }}" type="checkbox" class="hidden toggle-switch" data-id="{{ $product->id }}" {{ $product->is_flash ? 'checked' : '' }} />
              <div class="w-10 h-6 bg-gray-200 rounded-full relative">
                <div class="dot absolute left-1 top-1 w-4 h-4 bg-white rounded-full transition"></div>
              </div>
            </label>
          </td>
          <td class="border border-gray-300 px-4 py-2">{{ $product->status }}</td>
          <td class="border border-gray-300 px-4 py-2">{{ $product->remarks }}</td>
          <td class="px-2 py-2 mt-4 flex justify-center space-x-2">
            <button class="text-white bg-blue-500 hover:bg-blue-700 w-8 h-8 flex items-center justify-center rounded-md">
              <i class="ri-alarm-line text-sm"></i>
            </button>
            <button class="text-white bg-red-500 hover:bg-red-700 w-8 h-8 flex items-center justify-center rounded-md">
              <i class="ri-close-line text-sm"></i>
            </button>
            <button class="text-white bg-green-500 hover:bg-green-700 w-8 h-8 flex items-center justify-center rounded-md">
              <i class="ri-check-line text-sm"></i>
            </button>
            <button class="text-white bg-green-500 hover:bg-green-700 w-8 h-8 flex items-center justify-center rounded-md">
              <i class="ri-eye-line text-sm"></i>
            </button>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <!-- Pagination and Show Entries Section at the Bottom -->
  <div class="flex justify-between items-center mt-4">
    <div class="flex items-center space-x-2">
      <span class="ml-4 text-gray-700">Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} of {{ $products->total() }} entries</span>
    </div>
    <div class="flex items-center space-x-2">
      {{ $products->links() }}
    </div>
  </div>
</div>

<script>
document.querySelectorAll('.toggle-switch').forEach(toggle => {
  toggle.addEventListener('change', function () {
    const dot = this.parentNode.querySelector('.dot');
    const productId = this.getAttribute('data-id');
    const newState = this.checked ? 1 : 0;

    // Toggle visual effect
    if (this.checked) {
      dot.style.transform = 'translateX(100%)';
      dot.style.backgroundColor = 'green';
    } else {
      dot.style.transform = 'translateX(0)';
      dot.style.backgroundColor = 'white';
    }

    // Send AJAX request to update the product status in the database
    fetch(`/admin/product/update-toggle/${productId}`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': '{{ csrf_token() }}', // CSRF token for security
      },
      body: JSON.stringify({
        state: newState,
        type: this.id.startsWith('status') ? 'visibility' : 'is_flash', // Determine which field to update
      }),
    })
    .then(response => response.json())
    .then(data => {
      if (!data.success) {
        // If the update fails, reset the toggle state
        this.checked = !this.checked;
        dot.style.transform = this.checked ? 'translateX(100%)' : 'translateX(0)';
        dot.style.backgroundColor = this.checked ? 'green' : 'white';
      }
    })
    .catch(error => {
      // Handle error if the request fails
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
