<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Category and Upload Image</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    /* Ensure the form container is scrollable on smaller screens */
    .form-container {
      max-height: 90vh; /* Limits the form height to 90% of the viewport height */
      overflow-y: auto; /* Adds vertical scrolling if the content exceeds max height */
    }
  </style>
</head>
<body class="bg-gradient-to-r from-indigo-50 via-indigo-100 to-indigo-300 h-screen flex justify-center items-center">

<div class="form-container w-full max-w-md p-6 bg-white rounded-lg shadow-lg">
  <form action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
    @csrf

    <!-- Category Dropdown -->
    <div>
        <label for="category_id" class="block text-gray-600 font-medium">Category</label>
        <select name="category_id" id="category_id"
                class="w-full mt-1 p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option value="" disabled selected>Select a category</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" 
                        data-subcategories="{{ json_encode($category->subcategories) }}">
                    {{ $category->category_name }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Subcategory Dropdown -->
    <div>
        <label for="sub_category_id" class="block text-gray-600 font-medium">Sub-Category</label>
        <select name="sub_category_id" id="sub_category_id"
                class="w-full mt-1 p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option value="" disabled selected>Select a sub-category</option>
        </select>
    </div>

    <!-- Product Name -->
    <div>
        <label for="product_name" class="block text-gray-600 font-medium">Product Name</label>
        <input type="text" name="product_name" id="product_name" 
               class="w-full mt-1 p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
               required>
    </div>

    <!-- Brand -->
    <div>
        <label for="brand" class="block text-gray-600 font-medium">Brand</label>
        <input type="text" name="brand" id="brand" 
               class="w-full mt-1 p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
               required>
    </div>

    <!-- Price -->
    <div>
        <label for="price" class="block text-gray-600 font-medium">Price</label>
        <input type="number" name="price" id="price" 
               class="w-full mt-1 p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
               step="0.01" min="0" required>
    </div>

    <!-- Quantity -->
    <div>
        <label for="quantity" class="block text-gray-600 font-medium">Quantity</label>
        <input type="number" name="quantity" id="quantity" 
               class="w-full mt-1 p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
               min="1" required>
    </div>

    <!-- Description -->
    <div>
        <label for="description" class="block text-gray-600 font-medium">Description</label>
        <textarea name="description" id="description" rows="4" 
                  class="w-full mt-1 p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                  required></textarea>
    </div>

    <!-- Product Image -->
    <div>
        <label for="image" class="block text-gray-600 font-medium">Product Image</label>
        <input type="file" name="image" id="image" 
               class="w-full mt-1 p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
               accept="image/*" required>
    </div>

    <!-- Submit Button -->
    <button type="submit"
            class="w-full bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-lg transition">
        Add Product
    </button>
  </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    const categorySelect = document.getElementById('category_id');
    const subCategorySelect = document.getElementById('sub_category_id');
    
    categorySelect.addEventListener('change', function() {
        const selectedCategory = categorySelect.options[categorySelect.selectedIndex];
        const subcategories = JSON.parse(selectedCategory.getAttribute('data-subcategories'));

        // Clear current subcategory options
        subCategorySelect.innerHTML = '<option value="" disabled selected>Select a sub-category</option>';

        // If no subcategories exist, show a message
        if (subcategories.length === 0) {
            const noSubcategoryOption = document.createElement('option');
            noSubcategoryOption.value = '';
            noSubcategoryOption.textContent = 'No sub-categories available';
            subCategorySelect.appendChild(noSubcategoryOption);
        } else {
            // Add new subcategory options
            subcategories.forEach(function(subcategory) {
                const option = document.createElement('option');
                option.value = subcategory.id;
                option.textContent = subcategory.subcategory_name;
                subCategorySelect.appendChild(option);
            });
        }
    });
});
</script>
</body>
</html>
