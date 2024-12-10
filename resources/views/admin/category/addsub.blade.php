<script src="https://cdn.tailwindcss.com"></script>
<div class="bg-gradient-to-r from-red-600 to-red-500 text-white flex items-center justify-between px-8 py-6 absolute top-0 left-0 right-0 -z-30 shadow-lg mb-6 rounded-b-lg">
  <h1 class="text-4xl font-extrabold ml-32 py-2">Add Subcategory</h1>
</div>

<div class="p-6">
  <!-- Form to add a subcategory -->
  <div class="max-w-4xl mx-auto p-8 bg-white shadow-lg rounded-lg mt-10 border-t-4 border-red-500">
    <form action="{{ route('admin.category.addsub') }}" method="POST">
      @csrf
      <div class="mb-6">
        <label for="category" class="block text-gray-700 text-lg font-semibold mb-2">Category</label>
        <select name="categories_id" id="category" class="border border-gray-300 px-4 py-3 w-full rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500" required>
          <option value="">Select a category</option>
          @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
          @endforeach
        </select>
      </div>

      <div class="mb-6">
        <label for="subcategory_name" class="block text-gray-700 text-lg font-semibold mb-2">Subcategory Name</label>
        <input type="text" name="subcategory_name" id="subcategory_name" class="border border-gray-300 px-4 py-3 w-full rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500" required />
      </div>

      <div class="mb-6">
        <label for="paragraph" class="block text-gray-700 text-lg font-semibold mb-2">Description (Optional)</label>
        <textarea name="paragraph" id="paragraph" class="border border-gray-300 px-4 py-3 w-full rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500" rows="4"></textarea>
      </div>

      <div class="flex justify-end">
        <button type="submit" class="bg-red-600 text-white px-6 py-3 rounded-full hover:bg-red-700 transition duration-300">Save Subcategory</button>
      </div>
    </form>
  </div>
</div>
