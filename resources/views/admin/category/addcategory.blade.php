<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Category and Upload Image</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-indigo-50 via-indigo-100 to-indigo-300 h-screen flex justify-center items-center">

  <!-- Fullscreen Form Container -->
  <div class="w-full max-w-3xl px-8 py-10 bg-white rounded-lg shadow-lg shadow-indigo-300/50">
    <!-- Form Header -->
    <div class="text-center mb-10">
      <h1 class="text-4xl font-bold text-gray-900 mb-3">Create New Category</h1>
      <p class="text-lg text-gray-500">Add a new category and upload an image to represent it.</p>
    </div>

    <!-- Back and Add Subcategory Links -->
    <div class="mb-8 flex justify-between space-x-4">
      <!-- Back Button -->
      <a href="{{route('admin.category.category')}}" class="flex items-center text-sm text-indigo-600 font-medium bg-white border-2 border-indigo-600 rounded-lg py-2 px-4 hover:bg-indigo-700 hover:text-white transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-500">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M19 12H5"></path>
        </svg>
        Back to Categories
      </a>

    
    </div>

    <!-- Form -->
    <form action="{{route('admin.category.addcategory')}}" method="POST" enctype="multipart/form-data">
      @csrf

      <!-- Category Name Input -->
      <div class="mb-6">
        <label for="category" class="block text-sm font-medium text-gray-700">Category Name</label>
        <input type="text" id="category" name="category_name" placeholder="Enter category name"
               class="mt-2 px-5 py-3 w-full border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none transition duration-300 hover:border-indigo-400 text-lg">
      </div>

      <!-- Image Upload Input -->
      <div class="mb-6">
        <label for="image" class="block text-sm font-medium text-gray-700">Upload Image</label>
        <input type="file" id="image" name="image" accept="image/*"
               class="mt-2 px-5 py-3 w-full border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none transition duration-300 hover:border-indigo-400 text-lg">
      </div>

      <!-- Submit Button -->
      <div class="flex justify-center">
        <button type="submit"
                class="w-full md:w-auto px-6 py-3 bg-gradient-to-r from-indigo-600 to-indigo-700 text-white font-semibold rounded-lg hover:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-300 transform hover:scale-105">
          Submit
        </button>
      </div>
    </form>
  </div>

</body>
</html>
