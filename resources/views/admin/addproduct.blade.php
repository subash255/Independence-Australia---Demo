<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Category and Upload Image</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-indigo-50 via-indigo-100 to-indigo-300 min-h-screen flex justify-center items-center py-10">

  <!-- Form Container with 3 Columns and 2 Rows -->
  <div class="w-full max-w-4xl bg-white p-8 rounded-xl shadow-xl border border-gray-200 space-y-6">

    <!-- Back Button -->
    <a href="{{route('admin.product.product')}}" class="text-gray-700 hover:text-indigo-600 text-sm font-medium flex items-center space-x-2 mb-4">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
      </svg>
      <span>Back</span>
    </a>

    <!-- Title -->
    <h2 class="text-3xl font-semibold text-center text-gray-800 mb-6">Add New Product</h2>
    
    <!-- Form -->
    <form action="{{ route('admin.addproduct') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

      @csrf

      <!-- First Row - 3 Columns -->

      <!-- Category Dropdown -->
      <div class="col-span-1">
        <label for="categories_id" class="block text-gray-700 text-sm font-medium">Category</label>
        <select name="categories_id" id="categories_id"
                class="mt-2 block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none text-gray-700 text-sm shadow-sm">
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
      <div class="col-span-1">
        <label for="subcategories_id" class="block text-gray-700 text-sm font-medium">Sub-Category</label>
        <select name="subcategories_id" id="subcategories_id"
                class="mt-2 block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none text-gray-700 text-sm shadow-sm">
            <option value="" disabled selected>Select a sub-category</option>
        </select>
      </div>

      <!-- Product Name -->
      <div class="col-span-1">
        <label for="product_name" class="block text-gray-700 text-sm font-medium">Product Name</label>
        <input type="text" name="product_name" id="product_name" 
               class="mt-2 block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none text-gray-700 text-sm shadow-sm" 
               required>
      </div>

      <!-- Second Row - 3 Columns -->

      <!-- Brand -->
      <div class="col-span-1">
        <label for="brand" class="block text-gray-700 text-sm font-medium">Brand</label>
        <input type="text" name="brand" id="brand" 
               class="mt-2 block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none text-gray-700 text-sm shadow-sm" 
               required>
      </div>

      <!-- Price -->
      <div class="col-span-1">
        <label for="price" class="block text-gray-700 text-sm font-medium">Price</label>
        <input type="number" name="price" id="price" 
               class="mt-2 block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none text-gray-700 text-sm shadow-sm" 
               step="0.01" min="0" required>
      </div>

      <!-- Quantity -->
      <div class="col-span-1">
        <label for="quantity" class="block text-gray-700 text-sm font-medium">Quantity</label>
        <input type="number" name="quantity" id="quantity" 
               class="mt-2 block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none text-gray-700 text-sm shadow-sm" 
               min="1" required>
      </div>

      <!-- Third Row - Full-width (2 Columns) -->

      <!-- Description -->
      <div class="col-span-3">
        <label for="description" class="block text-gray-700 text-sm font-medium">Description</label>
        <textarea name="description" id="description" rows="4" 
                  class="mt-2 block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none text-gray-700 text-sm shadow-sm" 
                  required></textarea>
      </div>

      <!-- Product Image -->
      <div class="col-span-3">
        <label for="image" class="block text-gray-700 text-sm font-medium">Product Image</label>
        <input type="file" name="photopath" id="image" 
               class="mt-2 block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none text-gray-700 text-sm shadow-sm" 
               accept="image/*" required>
      </div>

      <!-- Submit Button -->
      <div class="col-span-3 mt-6">
        <button type="submit"
                class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 px-6 rounded-lg transition duration-300 ease-in-out transform hover:scale-105">
          Add Product
        </button>
      </div>

    </form>
  </div>

  <!-- Script for Dynamic Subcategories -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const categorySelect = document.getElementById('categories_id');
      const subCategorySelect = document.getElementById('subcategories_id');
      
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
