<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create SubCategory</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-indigo-50 via-indigo-100 to-indigo-300 flex justify-center items-center min-h-screen px-4 sm:px-8">

  <!-- Fullscreen Form Container -->
  <div class="w-full max-w-3xl sm:max-w-4xl px-6 py-10 bg-white rounded-lg shadow-lg shadow-indigo-300/50 mt-12 sm:mt-16">

    <!-- Header Section -->
    <div class="text-center mb-8">
      <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-3">Add Subcategory</h1>
      <p class="text-base sm:text-lg text-gray-500">Add a new subcategory to an existing category and provide a description.</p>
    </div>

    <!-- Back Button -->
    <div class="mb-8 flex justify-start">
      <a href="{{route('admin.category.addcategory')}}" class="flex items-center text-sm text-indigo-600 font-medium bg-white border-2 border-indigo-600 rounded-lg py-2 px-4 hover:bg-indigo-700 hover:text-white transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-500">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M19 12H5"></path>
        </svg>
        Back
      </a>
    </div>

    <!-- Form -->
    <form action="{{ route('admin.category.addsub') }}" method="POST">
      @csrf

      <!-- Category Selection -->
      <div class="mb-6">
        <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
        <select name="categories_id" id="category" class="mt-2 px-4 py-3 w-full border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none transition duration-300 hover:border-indigo-400 text-lg" required>
          <option value="">Select a category</option>
          @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
          @endforeach
        </select>
      </div>

      <!-- Subcategory Name Input -->
      <div class="mb-6">
        <label for="subcategory_name" class="block text-sm font-medium text-gray-700">Subcategory Name</label>
        <input type="text" name="subcategory_name" id="subcategory_name" class="mt-2 px-4 py-3 w-full border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none transition duration-300 hover:border-indigo-400 text-lg" required />
      </div>

      <!-- Description -->
      <div class="mb-6">
        <label for="paragraph" class="block text-sm font-medium text-gray-700">Description (Optional)</label>
        <textarea name="paragraph" id="paragraph" class="mt-2 px-4 py-3 w-full border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none transition duration-300 hover:border-indigo-400 text-lg" rows="4"></textarea>
      </div>

      <!-- Submit Button -->
      <div class="flex justify-center">
        <button type="submit"
                class="px-6 py-3 bg-gradient-to-r from-indigo-600 to-indigo-700 text-white font-semibold rounded-lg hover:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-300 transform hover:scale-105">
          Save Subcategory
        </button>
      </div>
    </form>
  </div>

</body>
</html>
