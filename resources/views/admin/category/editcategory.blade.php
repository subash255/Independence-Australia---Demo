<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Category</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 py-12 px-4">

  <!-- Container -->
  <div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-lg">
    <button class="text-2xl font-bold text-center text-gray-800 mb-6">Edit Category</button>

    <!-- Back Button -->
    <div class="mb-6 flex justify-between">
      <a href="{{route('admin.category.category')}}" class="text-indigo-600 hover:text-indigo-700">← Back</a>
    </div>

    <!-- Form -->
    <form action="{{route('admin.category.updatecategory', $category->id)}}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('patch')
      
      <div class="mb-6">
        <label for="category" class="block text-sm font-medium text-gray-700">Category Name</label>
        <!-- Pre-populate the category name field -->
        <input type="text" id="category" name="category_name" value="{{ old('category_name', $category->category_name) }}" placeholder="Enter category name"
               class="mt-2 px-4 py-2 w-full border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none">
      </div>

      <!-- Current Image Display -->
      @if($category->image)
        <div class="mb-6">
          <label class="block text-sm font-medium text-gray-700">Current Image</label>
          <img src="{{ asset('images/brand/' . $category->image) }}" alt="Category Image" class="mt-2 w-full h-auto border border-gray-300 rounded-lg">
        </div>
      @endif

      <!-- New Image Upload (Optional) -->
      <div class="mb-6">
        <label for="image" class="block text-sm font-medium text-gray-700">Upload New Image (Optional)</label>
        <input type="file" id="image" name="image" accept="image/*"
               class="mt-2 px-4 py-2 w-full border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none">
      </div>

      <!-- Submit Button -->
      <div class="flex justify-center">
        <button type="submit"
                class="px-6 py-3 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
          Update Category
        </button>
      </div>
    </form>
  </div>

</body>
</html>
