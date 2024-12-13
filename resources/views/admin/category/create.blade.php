<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Category</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-indigo-50 via-indigo-100 to-indigo-300 h-screen flex justify-center items-center">

  <!-- Fullscreen Form Container -->
  <div class="w-full max-w-3xl px-8 py-10 bg-white rounded-lg shadow-lg shadow-indigo-300/50">
    <div class="text-center mb-10">
      <h1 class="text-4xl font-bold text-gray-900 mb-3">Create New Category</h1>
      <p class="text-lg text-gray-500">Add a new category and upload an image to represent it.</p>
    </div>

    <a href="{{route('admin.category.index')}}" class="text-gray-700 hover:text-indigo-600 text-sm font-medium flex items-center space-x-2 mb-6">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
      </svg>
      <span>Back</span>
    </a>

    <!-- Form -->
    <form action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <!-- Category Name Input -->
      <div class="mb-6">
        <label for="category" class="block text-sm font-medium text-gray-700">Category Name</label>
        <input type="text" id="category" name="category_name" placeholder="Enter category name"
               class="mt-2 px-5 py-3 w-full border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none transition duration-300 hover:border-indigo-400 text-lg" oninput="generateSlug()">
      </div>

      <!-- Slug Input (auto-generated) -->
      <div class="mb-6">
        <label for="slug" class="block text-sm font-medium text-gray-700">Slug</label>
        <input type="text" id="slug" name="slug" placeholder="Generated slug"
               class="mt-2 px-5 py-3 w-full border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none transition duration-300 hover:border-indigo-400 text-lg">
      </div>

      <!-- Image Upload Input -->
      <div class="mb-6">
        <label for="image" class="block text-sm font-medium text-gray-700">Upload Image</label>
        <input type="file" id="image" name="image" accept="image/* " required 
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

<script>
    // Function to generate slug from category name
    function generateSlug() {
        let input1 = document.getElementById('category').value;
        let slug = input1.trim().replace(/\s+/g, '-').toLowerCase();
        document.getElementById('slug').value = slug;
    }

    // Remove 'readonly' from the slug input before submitting the form
    document.querySelector('form').addEventListener('submit', function() {
        document.getElementById('slug').removeAttribute('readonly');
    });
</script>
