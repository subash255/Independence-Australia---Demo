@extends('layouts.admin')

@section('content')


<body class="p-6">

  <!-- Main container with shadow -->
  <div class="max-w-7xl mx-auto p-6 bg-white shadow-lg mt-10">

    <!-- Add Category Button placed to the right -->
    <div class="mb-4 flex justify-end">
      <a  href="{{route('admin.category.addcategory')}}" class="bg-red-500 text-white px-4 py-2 rounded-full hover:bg-white hover:text-red-500">Add Category</a>
    </div>

    <div class="flex justify-between mb-4">
      <!-- Left: Show entries -->
      <div>
        <label for="entries" class="mr-2">Show entries:</label>
        <select id="entries" class="border border-gray-300 px-2 py-1">
          <option value="5">5</option>
          <option value="10">10</option>
          <option value="15">15</option>
        </select>
      </div>

      <!-- Right: Search with label beside -->
      <div class="flex items-center space-x-2">
        <span class="text-gray-700">Search:</span>
        <input type="text" id="search" placeholder="Search..." class="border border-gray-300 px-4 py-2 w-96" />
      </div>
    </div>

    <table class="min-w-full border-collapse border border-gray-300">
      <thead>
        <tr>
          <th class="border border-gray-300 px-4 py-2">Order</th>
          <th class="border border-gray-300 px-4 py-2">Icon</th>
          <th class="border border-gray-300 px-4 py-2">Category Name</th>
          <th class="border border-gray-300 px-4 py-2">Slug</th>
          <th class="border border-gray-300 px-4 py-2">Status</th>
          <th class="border border-gray-300 px-4 py-2">Action</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="border border-gray-300 px-4 py-2">1</td>
          <td class="border border-gray-300 px-4 py-2">🥩</td> 
          <td class="border border-gray-300 px-4 py-2">Meat&seafood</td>
          <td class="border border-gray-300 px-4 py-2">meat-&-seafood</td>
          <td class="border border-gray-300 px-4 py-2">
            <!-- Toggle Button for Active/Inactive Status -->
            <label for="status1" class="inline-flex items-center cursor-pointer">
              <input id="status1" type="checkbox" class="hidden" />
              <div class="w-10 h-6 bg-gray-200 rounded-full relative">
                <div class="dot absolute left-1 top-1 w-4 h-4 bg-white rounded-full transition"></div>
              </div>
            </label>
          </td>
          <td class="border border-gray-300 px-2 py-1 flex justify-center space-x-4">
            <!-- Action buttons with colored backgrounds -->
            <button class="text-white bg-blue-500 hover:bg-blue-700 p-2 py-0 "><i class="ri-edit-box-line"></i></button>
            <button class="text-white bg-red-500 hover:bg-red-700 p-2 "><i class="ri-delete-bin-line"></i></button>
            <button class="text-white bg-green-500 hover:bg-green-700 p-2 "><i class="ri-settings-5-line"></i></button>
          </td>
        </tr>
        <tr>
          <td class="border border-gray-300 px-4 py-2">2</td>
          <td class="border border-gray-300 px-4 py-2">🍰</td>
          <td class="border border-gray-300 px-4 py-2">Bakery</td>
          <td class="border border-gray-300 px-4 py-2">bakery</td>
          <td class="border border-gray-300 px-4 py-2">
            <!-- Toggle Button for Active/Inactive Status -->
            <label for="status2" class="inline-flex items-center cursor-pointer">
              <input id="status2" type="checkbox" class="hidden" />
              <div class="w-10 h-6 bg-gray-200 rounded-full relative">
                <div class="dot absolute left-1 top-1 w-4 h-4 bg-white rounded-full transition"></div>
              </div>
            </label>
          </td>
          <td class="border border-gray-300 px-2 py-1 flex justify-center space-x-4">
            <!-- Action buttons with colored backgrounds -->
            <button class="text-white bg-blue-500 hover:bg-blue-700 p-2 py-0 "><i class="ri-edit-box-line"></i></button>
            <button class="text-white bg-red-500 hover:bg-red-700 p-2 "><i class="ri-delete-bin-line"></i></button>
            <button class="text-white bg-green-500 hover:bg-green-700 p-2 "><i class="ri-settings-5-line"></i></button>
          </td>
        </tr>
        <tr>
          <td class="border border-gray-300 px-4 py-2">3</td>
          <td class="border border-gray-300 px-4 py-2">🥤</td>
          <td class="border border-gray-300 px-4 py-2">Beverages</td>
          <td class="border border-gray-300 px-4 py-2">beverages</td>
          <td class="border border-gray-300 px-4 py-2">
            <!-- Toggle Button for Active/Inactive Status -->
            <label for="status3" class="inline-flex items-center cursor-pointer">
              <input id="status3" type="checkbox" class="hidden" />
              <div class="w-10 h-6 bg-gray-200 rounded-full relative">
                <div class="dot absolute left-1 top-1 w-4 h-4 bg-white rounded-full transition"></div>
              </div>
            </label>
          </td>
          <td class="border border-gray-300 px-2 py-1 flex justify-center space-x-4">
            <!-- Action buttons with colored backgrounds -->
            <button class="text-white bg-blue-500 hover:bg-blue-700 p-2 py-0 "><i class="ri-edit-box-line"></i></button>
            <button class="text-white bg-red-500 hover:bg-red-700 p-2 "><i class="ri-delete-bin-line"></i></button>
            <button class="text-white bg-green-500 hover:bg-green-700 p-2 "><i class="ri-settings-5-line"></i></button>
          </td>
        </tr>
        <tr>
          <td class="border border-gray-300 px-4 py-2">4</td>
          <td class="border border-gray-300 px-4 py-2">🧀</td> 
          <td class="border border-gray-300 px-4 py-2">Dairy&eggs</td>
          <td class="border border-gray-300 px-4 py-2">dairy-&-eggs</td>
          <td class="border border-gray-300 px-4 py-2">
            <!-- Toggle Button for Active/Inactive Status -->
            <label for="status4" class="inline-flex items-center cursor-pointer">
              <input id="status4" type="checkbox" class="hidden" />
              <div class="w-10 h-6 bg-gray-200 rounded-full relative">
                <div class="dot absolute left-1 top-1 w-4 h-4 bg-white rounded-full transition"></div>
              </div>
            </label>
          </td>
          <td class="border border-gray-300 px-2 py-1 flex justify-center space-x-4">
            <!-- Action buttons with colored backgrounds -->
            <button class="text-white bg-blue-500 hover:bg-blue-700 p-2 py-0 "><i class="ri-edit-box-line"></i></button>
            <button class="text-white bg-red-500 hover:bg-red-700 p-2 "><i class="ri-delete-bin-line"></i></button>
            <button class="text-white bg-green-500 hover:bg-green-700 p-2 "><i class="ri-settings-5-line"></i></button>
          </td>
        </tr>
        <tr>
          <td class="border border-gray-300 px-4 py-2">5</td>
          <td class="border border-gray-300 px-4 py-2">❄️</td> 
          <td class="border border-gray-300 px-4 py-2">Frozen</td>
          <td class="border border-gray-300 px-4 py-2">frozen</td>
          <td class="border border-gray-300 px-4 py-2">
            <!-- Toggle Button for Active/Inactive Status -->
            <label for="status5" class="inline-flex items-center cursor-pointer">
              <input id="status5" type="checkbox" class="hidden" />
              <div class="w-10 h-6 bg-gray-200 rounded-full relative">
                <div class="dot absolute left-1 top-1 w-4 h-4 bg-white rounded-full transition"></div>
              </div>
            </label>
          </td>
          <td class="border border-gray-300 px-2 py-1 flex justify-center space-x-4">
            <!-- Action buttons with colored backgrounds -->
            <button class="text-white bg-blue-500 hover:bg-blue-700 p-2 py-0 "><i class="ri-edit-box-line"></i></button>
            <button class="text-white bg-red-500 hover:bg-red-700 p-2 "><i class="ri-delete-bin-line"></i></button>
            <button class="text-white bg-green-500 hover:bg-green-700 p-2 "><i class="ri-settings-5-line"></i></button>
          </td>
        </tr>
      </tbody>
    </table>

    <!-- Pagination and Show Entries Section at the Bottom -->
    <div class="flex justify-between items-center mt-4">
      <!-- Left: Show entries -->
      <div class="flex items-center space-x-2">
        <span class="ml-4 text-gray-700">Showing 1 to 5 of 5 entries</span>
      </div>

      <!-- Right: Pagination -->
      <div class="flex items-center space-x-2">
        <button class="border border-gray-300 px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-md">Previous</button>
        
        <!-- Page number display -->
        <span class="px-4 py-2 text-gray-700">Page 1 of 3</span>
        
        <button class="border border-gray-300 px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-md">Next</button>
      </div>
    </div>

  </div>

</body>
@endsection
