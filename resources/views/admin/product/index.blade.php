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

<!-- Main container -->
<div class="max-w-full mx-auto p-4 bg-white shadow-lg mt-[7rem] rounded-lg relative z-10">
    <div class="mb-4 flex justify-end space-x-4">
        <div class="mr-[27rem] mt-2">
            <a href="{{ route('admin.product.create') }}" class="text-red-500 font-medium bg-white border-2 border-red-500 rounded-lg py-2 px-4 hover:bg-red-600 hover:text-white transition duration-300">Add product</a>
        </div>
        <button class="bg-white border-2 border-blue-700 text-gray-900 px-4 py-2 rounded-md hover:bg-blue-700 hover:text-white" >Pending</button>
        <button class="bg-white border-2 border-green-600 text-gray-900 px-4 py-2 rounded-md hover:bg-green-600 hover:text-white" >Approved</button>
        <button class="bg-white border-2 border-red-600 text-gray-900 px-4 py-2 rounded-md hover:bg-red-600 hover:text-white" >Rejected</button>
    
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
        <tr class="border border-gray-300 product-row" data-product-id="{{ $product->id }}">
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
            <td class="border border-gray-300 px-7 py-2">{{ $product->product_name }}</td>
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
            <td id="status-cell-{{ $product->id }}" class="border border-gray-300 px-4 py-2">
                {{ ucfirst($product->status) }}
            </td>
            <td class="border border-gray-300 px-4 py-2">{{ $product->remarks }}</td>
            <td class="px-2 py-2 mt-4 flex justify-center space-x-2">
                <button class="text-white bg-blue-500 hover:bg-blue-700 w-8 h-8 flex items-center justify-center rounded-md" onclick="updateStatus('pending')">
                    <i class="ri-alarm-line text-sm"></i>
                </button>
                <button class="text-white bg-red-500 hover:bg-red-700 w-8 h-8 flex items-center justify-center rounded-md" onclick="updateStatus('rejected')">
                    <i class="ri-close-line text-sm"></i>
                </button>
                <button class="text-white bg-green-500 hover:bg-green-700 w-8 h-8 flex items-center justify-center rounded-md" onclick="updateStatus('approved')">
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
            {{ $products->appends(['status' => request('status')])->links() }}
        </div>
    </div>
</div>

<script>
document.querySelectorAll('.toggle-switch').forEach(toggle => {
  // Initialize the state based on whether it's checked or not
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
<script>

function updateStatus(status) {
    // Get all the product rows that need to be updated
    const selectedProducts = document.querySelectorAll('.product-row');  // Make sure to use the correct class for product rows

    if (selectedProducts.length === 0) {
        alert("No products found to update.");
        return;  // Exit if no products are found
    }

    let hasInvalidStatus = false; // Flag to check if any product has an invalid status

    // Check if the status is approved or rejected and ask for confirmation
    if (status === 'approved' || status === 'rejected') {
        const userConfirmed = window.confirm(`Are you sure you want to mark the selected products as ${status}?`);
        if (!userConfirmed) {
            return; // Exit if user cancels
        }
    }

    // Iterate over all the selected products and send the AJAX request
    selectedProducts.forEach(function(row) {
        const productId = row.getAttribute('data-product-id'); // Assume product row has a unique data-product-id
        const currentStatusCell = row.querySelector(`#status-cell-${productId}`); // Current status cell

        // Get current status of the product
        const currentStatus = currentStatusCell ? currentStatusCell.textContent.trim().toLowerCase() : '';

        // If status is not "pending", mark as invalid and skip further processing for this product
        if (currentStatus !== 'pending') {
            hasInvalidStatus = true; // Set the flag to true
            return;  // Skip to the next product row
        }

        // Disable other buttons after one is clicked
        const statusButtons = row.querySelectorAll('button');
        statusButtons.forEach(button => button.disabled = true); // Disable all buttons

        // Send the AJAX request to update the product's status
        fetch(`/admin/product/update-status/${productId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',  // CSRF token for security
            },
            body: JSON.stringify({
                status: status,  // 'pending', 'approved', or 'rejected'
            }),
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update the product row status text on success
                const statusCell = document.querySelector(`#status-cell-${productId}`);
                if (statusCell) {
                    statusCell.textContent = status.charAt(0).toUpperCase() + status.slice(1);  // Update status display
                }
            } else {
                alert('Failed to update status for product ID ' + productId);
            }
        })
        .catch(error => {
            console.error('Error updating status:', error);
            alert('Error updating status for product ID ' + productId);
        });
    });

    // If any product had an invalid status, show one alert and stop processing
    if (hasInvalidStatus) {
        alert('One or more products have already been processed or are not pending.');
    }
}

</script>




@endsection
