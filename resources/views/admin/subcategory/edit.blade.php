@extends('layouts.admin')

@section('content')

<!-- Flash Message -->
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

<div class="max-w-4xl mx-auto p-10 bg-white shadow-lg rounded-xl mt-[7rem]">
    <h1 class="text-4xl font-extrabold text-gray-800 text-center mb-6">Edit Subcategory</h1>

    <!-- Form -->
    <form action="{{ route('admin.subcategory.update', $subcategory->id) }}" method="POST" class="space-y-8">
        @csrf
        @method('PATCH')

        <!-- Display Errors -->
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded-md">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Category Dropdown -->
        <div class="mb-6">
            <label for="category_id" class="block text-lg font-medium text-gray-700">Category</label>
            <select name="category_id" id="category_id"
                class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ old('category_id', $subcategory->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->category_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Subcategory Dropdown -->
        <div class="mb-6">
            <label for="subcategory_id" class="block text-lg font-medium text-gray-700">Subcategory</label>
            <select name="subcategory_id" id="subcategory_id"
                class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                <option value="">Select Subcategory</option>
                @foreach ($subcategories as $sub)
                    <option value="{{ $sub->id }}"
                        {{ old('subcategory_id', $subcategory->id) == $sub->id ? 'selected' : '' }}>
                        {{ $sub->subcategory_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Subcategory Name Input -->
        <div class="mb-6">
            <label for="subcategory_name" class="block text-lg font-medium text-gray-700">Subcategory Name</label>
            <input type="text" name="subcategory_name" id="subcategory_name"
                class="mt-2 px-4 py-3 w-full border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                value="{{ old('subcategory_name', $subcategory->subcategory_name) }}" required>
        </div>

        <!-- Paragraph Input -->
        <div class="mb-6">
            <label for="paragraph" class="block text-lg font-medium text-gray-700">Paragraph</label>
            <textarea name="paragraph" id="paragraph"
                class="mt-2 block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none">{{ old('paragraph', $subcategory->paragraph) }}</textarea>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-between gap-4 mt-8">
            <!-- Cancel Button -->
            <button type="button" id="closeModalButton" class="w-full md:w-auto bg-red-500 font-semibold text-white py-2 px-4 rounded-lg hover:bg-red-600 transition duration-300 focus:outline-none">
                Cancel
            </button>

            <!-- Submit Button -->
            <button type="submit" class="w-full md:w-auto bg-gradient-to-r from-indigo-600 to-indigo-700 text-white font-semibold py-2 px-6 rounded-lg hover:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-300 transform hover:scale-105">
                Update Subcategory
            </button>
        </div>
    </form>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Initial load of subcategories for the selected category
        let categoryId = document.getElementById('category_id').value;
        loadSubcategories(categoryId);

        // Event listener for category change
        document.getElementById('category_id').addEventListener('change', function () {
            let selectedCategoryId = this.value;
            loadSubcategories(selectedCategoryId);
        });

        // Function to load subcategories based on the selected category
        function loadSubcategories(categoryId) {
            if (categoryId) {
                fetch(`/admin/subcategories/${categoryId}`)
                    .then(response => response.json())
                    .then(data => {
                        let subcategorySelect = document.getElementById('subcategory_id');
                        subcategorySelect.innerHTML = '<option value="">Select Subcategory</option>';

                        data.forEach(subcategory => {
                            let option = document.createElement('option');
                            option.value = subcategory.id;
                            option.textContent = subcategory.subcategory_name;
                            subcategorySelect.appendChild(option);
                        });

                        // Set the subcategory dropdown value to the existing subcategory
                        let selectedSubcategoryId = {{ $subcategory->id }};
                        if (selectedSubcategoryId) {
                            subcategorySelect.value = selectedSubcategoryId;
                        }
                    })
                    .catch(error => console.error('Error fetching subcategories:', error));
            } else {
                // If no category selected, clear subcategories
                document.getElementById('subcategory_id').innerHTML =
                    '<option value="">Select Subcategory</option>';
            }
        }
    });
</script>

@endsection
