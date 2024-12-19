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
    <a href="{{route('admin.product.index')}}" class="text-gray-700 hover:text-indigo-600 text-sm font-medium flex items-center space-x-2 mb-4">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
      </svg>
      <span>Back</span>
    </a>

    <!-- Title -->
    <h2 class="text-3xl font-semibold text-center text-gray-800 mb-6">Add New Product</h2>
    
    <!-- Form -->
    <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

      @csrf


      

     
      <!-- Product Name -->
      <div class="col-span-1">
        <label for="csv_file" class="block text-gray-700 text-sm font-medium">CSV File</label>
        <input type="file" name="csv_file" id="csv_file" 
               class="mt-2 block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none text-gray-700 text-sm shadow-sm" 
               accept=".csv, .xlsx" required>
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

  
  

</body>
</html>
