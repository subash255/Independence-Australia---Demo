<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Subcategory</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-r from-indigo-100 via-purple-100 to-pink-200 py-12 px-6">

    <!-- Form Container -->
    <form action="{{ route('admin.subcategory.update', $subcategory->id) }}" method="POST"
        class="max-w-4xl mx-auto p-8 bg-white shadow-lg rounded-lg space-y-8">
        @csrf
        @method('PATCH')
        <div class="text-center mb-8">
            <h1 class="text-4xl font-extrabold text-gray-800">Edit Subcategory</h1>
        </div>
        
        <!-- Back Button -->
        <a href="{{ route('admin.subcategory.index') }}" class="text-gray-700 hover:text-indigo-600 text-sm font-medium flex items-center space-x-2 mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
            </svg>
            <span>Back</span>
        </a>
        
        <!-- Error Messages -->
        @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded-md mb-6">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Category Dropdown -->
        <div class="form-group">
            <label for="category_id" class="block text-lg font-medium text-gray-700">Category</label>
            <select name="category_id" id="category_id"
                class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                @foreach ($categories as $category)
                <option value="{{ $category->id }}"
                    {{ old('category_id', $subcategory->category_id) == $category->id ? 'selected' : '' }}>
                    {{ $category->category_name }}
                </option>
                @endforeach
            </select>
        </div>

        <!-- Subcategory Dropdown -->
        <div class="form-group">
            <label for="subcategory_id" class="block text-lg font-medium text-gray-700">Subcategory</label>
            <select name="subcategory_id" id="subcategory_id"
                class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
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
        <div class="form-group">
            <label for="subcategory_name" class="block text-lg font-medium text-gray-700">Subcategory Name</label>
            <input type="text" name="subcategory_name" id="subcategory_name"
                class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                value="{{ old('subcategory_name', $subcategory->subcategory_name) }}" required>
        </div>

        <!-- Paragraph Input -->
        <div class="form-group">
            <label for="paragraph" class="block text-lg font-medium text-gray-700">Paragraph</label>
            <textarea name="paragraph" id="paragraph"
                class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">{{ old('paragraph', $subcategory->paragraph) }}</textarea>
        </div>

        <!-- Submit Button -->
        <button type="submit"
            class="w-full bg-gradient-to-r from-indigo-500 to-purple-600 text-white py-3 px-6 rounded-md shadow-md hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50 transition-all duration-300 ease-in-out transform hover:scale-105">
            Update Subcategory
        </button>
    </form>

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

</body>

</html>
