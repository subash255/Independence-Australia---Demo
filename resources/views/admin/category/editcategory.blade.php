<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Category</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-indigo-100 via-purple-100 to-pink-200 py-12 px-6">

  <!-- Container -->
  <div class="max-w-4xl mx-auto bg-white p-10 rounded-xl shadow-lg">
    <!-- Header -->
    <div class="text-center mb-8">
      <h1 class="text-4xl font-extrabold text-gray-800">Edit Category</h1>
    </div>

        <!-- Back Button -->
        <a href="{{route('admin.category.category')}}" class="text-gray-700 hover:text-indigo-600 text-sm font-medium flex items-center space-x-2 mb-4">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
          </svg>
          <span>Back</span>
        </a>

    <!-- Form -->
    <form action="{{route('admin.category.updatecategory', $category->id)}}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('patch')

      <!-- Category Name Input -->
      <div class="mb-8">
        <label for="category" class="block text-lg font-medium text-gray-700">Category Name</label>
        <input type="text" id="category" name="category_name" value="{{ old('category_name', $category->category_name) }}" placeholder="Enter category name"
               class="mt-3 px-6 py-4 w-full border border-gray-300 rounded-lg shadow-md focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-all duration-300">
      </div>

      <!-- Current Image Display -->
      @if($category->image)
        <div class="mb-8">
          <label class="block text-lg font-medium text-gray-700">Current Image</label>
          <!-- Set image width to a smaller size -->
          <img src="{{ asset('images/brand/' . $category->image) }}" alt="Category Image" class="mt-3 w-64 h-auto mx-auto border border-gray-300 rounded-lg shadow-md">
        </div>
      @endif

      <!-- New Image Upload (Optional) -->
      <div class="mb-8">
        <label for="image" class="block text-lg font-medium text-gray-700">Upload New Image (Optional)</label>
        <input type="file" id="image" name="image" accept="image/*"
               class="mt-3 px-6 py-4 w-full border border-gray-300 rounded-lg shadow-md focus:ring-2 focus:ring-indigo-500 focus:outline-none">
      </div>

      <!-- Submit Button -->
      <div class="flex justify-center">
        <button type="submit"
                class="w-full py-4 bg-gradient-to-r from-indigo-500 to-purple-600 text-white font-semibold rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-all duration-300 
                transform hover:scale-105 hover:bg-indigo-600 hover:from-indigo-600 hover:to-purple-500 shadow-lg">
          Update Category
        </button>
      </div>
    </form>
  </div>

</body>
</html>
