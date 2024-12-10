@extends('layouts.admin')
@section('content')

  <!-- Main container -->
  <div class="max-w-8xl mx-auto p-4 bg-white shadow-lg mt-[7rem] rounded-lg relative z-10">
    <div class="mb-4 flex justify-end space-x-4">
      <button class="bg-white border-2 border-blue-700 text-gray-900 px-4 py-2 rounded-md hover:bg-blue-700 hover:text-white">Pending</button>
      <button class="bg-white border-2 border-green-600 text-gray-900 px-4 py-2 rounded-md hover:bg-green-600 hover:text-white">Approved</button>
      <button class="bg-white border-2 border-red-600 text-gray-900 px-4 py-2 rounded-md hover:bg-red-600 hover:text-white">Rejected</button>
    </div>

    <div class="flex justify-between mb-4">
      <!-- Left: Show entries with tag above -->
      <div>
        <div class="mb-2">
          <a href="{{route('admin.product.addproduct')}}" class="bg-blue-500 text-white px-3 py-1 text-sm rounded-full">Add product</a>
        </div>
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

    <!-- Table Container with horizontal scroll if needed -->
    <div class="overflow-x-auto">
      <table class="min-w-full border-collapse border border-gray-300 table-auto">
        <thead>
          <tr>
            <th class="border border-gray-300 px-2 py-2 font-medium">S.N</th>
            <th class="border border-gray-300 px-2 py-2 font-medium">Photo</th>
            <th class="border border-gray-300 px-2 py-2 font-medium">Category Name</th>
            <th class="border border-gray-300 px-2 py-2 font-medium">Subcategory Name</th>
            <th class="border border-gray-300 px-7 py-2 font-medium">Product Name</th>
            <th class="border border-gray-300 px-2 py-2 font-medium">Visibility</th>
            <th class="border border-gray-300 px-2 py-2 font-medium">Is Flash</th>
            <th class="border border-gray-300 px-2 py-2 font-medium">Status</th>
            <th class="border border-gray-300 px-2 py-2 font-medium">Remarks</th>
            <th class="border border-gray-300 px-2 py-2 font-medium">Action</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="border border-gray-300 px-4 py-2">1</td>
            <td class="border border-gray-300 px-4 py-2">🥩</td> 
            <td class="border border-gray-300 px-4 py-2">Meat & Seafood</td>
            <td class="border border-gray-300 px-4 py-2">Shrimp</td>
            <td class="border border-gray-300 px-4 py-2">All Natural Italian-style meat</td>
            <td class="border border-gray-300 px-4 py-2">
              <!-- Toggle Button for Active/Inactive Status -->
              <label for="status1" class="inline-flex items-center cursor-pointer">
                <input id="status1" type="checkbox" class="hidden toggle-switch" />
                <div class="w-10 h-6 bg-gray-200 rounded-full relative">
                  <div class="dot absolute left-1 top-1 w-4 h-4 bg-white rounded-full transition"></div>
                </div>
              </label>
            </td>
            <td class="border border-gray-300 px-4 py-2">
              <!-- Toggle Button for Is Flash -->
              <label for="flash1" class="inline-flex items-center cursor-pointer">
                <input id="flash1" type="checkbox" class="hidden toggle-switch" />
                <div class="w-10 h-6 bg-gray-200 rounded-full relative">
                  <div class="dot absolute left-1 top-1 w-4 h-4 bg-white rounded-full transition"></div>
                </div>
              </label>
            </td>
            <td class="border border-gray-300 px-4 py-2">pending</td>
            <td class="border border-gray-300 px-4 py-2"></td>
            <td class="border border-gray-300 px-2 py-1 flex justify-center space-x-2">
              <button class="text-white bg-blue-500 hover:bg-blue-700 w-8 h-8 flex items-center justify-center rounded-md">
                <i class="ri-alarm-line text-sm"></i>
              </button>
              <button class="text-white bg-red-500 hover:bg-red-700 w-8 h-8 flex items-center justify-center rounded-md">
                <i class="ri-close-line text-sm"></i>
              </button>
              <button class="text-white bg-green-500 hover:bg-green-700 w-8 h-8 flex items-center justify-center rounded-md">
                <i class="ri-check-line text-sm"></i>
              </button>
              <button class="text-white bg-green-500 hover:bg-green-700 w-8 h-8 flex items-center justify-center rounded-md">
                <i class="ri-eye-line text-sm"></i>
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Pagination and Show Entries Section at the Bottom -->
    <div class="flex justify-between items-center mt-4">
      <div class="flex items-center space-x-2">
        <span class="ml-4 text-gray-700">Showing 1 to 5 of 5 entries</span>
      </div>
      <div class="flex items-center space-x-2">
        <button class="border border-gray-300 px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-md">Previous</button>
        <span class="px-4 py-2 text-gray-700">Page 1 of 3</span>
        <button class="border border-gray-300 px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-md">Next</button>
      </div>
    </div>
  </div>

<script>
document.querySelectorAll('.toggle-switch').forEach(toggle => {
  toggle.addEventListener('change', function () {
    const dot = this.parentNode.querySelector('.dot');
    if (this.checked) {
      dot.style.transform = 'translateX(100%)';
      dot.style.backgroundColor = 'green';
    } else {
      dot.style.transform = 'translateX(0)';
      dot.style.backgroundColor = 'white';
    }
  });
});
</script>

@endsection
