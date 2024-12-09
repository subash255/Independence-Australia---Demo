<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Category and Upload Image</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 py-12 px-4">

  <!-- Container -->
  <div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-lg">
    <h1 class="text-2xl font-bold text-center text-gray-800 mb-6">Add Category</h1>

    <!-- Form -->
    <form action="#" method="POST" enctype="multipart/form-data">
      <!-- Category Input -->
      <div class="mb-6">
        <label for="category" class="block text-sm font-medium text-gray-700">Category Name</label>
        <input type="text" id="category" name="category" placeholder="Enter category name"
               class="mt-2 px-4 py-2 w-full border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none">
      </div>

      <!-- Image Upload -->
      <div class="mb-6">
        <label for="image" class="block text-sm font-medium text-gray-700">Upload Image</label>
        <input type="file" id="image" name="image" accept="image/*"
               class="mt-2 px-4 py-2 w-full border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none">
      </div>

      <!-- Submit Button -->
      <div class="flex justify-center">
        <button type="submit"
                class="px-6 py-3 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
          Submit
        </button>
      </div>
    </form>
  </div>

</body>
</html>
