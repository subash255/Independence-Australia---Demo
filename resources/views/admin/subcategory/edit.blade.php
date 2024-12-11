<script src="https://cdn.tailwindcss.com"></script>

<form action="{{ route('admin.subcategory.update', $subcategory->id) }}" method="POST" class="max-w-3xl mx-auto p-6 bg-white shadow-lg rounded-lg space-y-6">
    @csrf
    @method('PATCH')

    <!-- Category Display (Non-editable) -->
    <div class="form-group">
        <label for="category_name" class="block text-lg font-medium text-gray-700">Category</label>
        <input type="text" id="category_name" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" value="{{ $subcategory->category->category_name }}" readonly>
    </div>

    <!-- Subcategory Name Input -->
    <div class="form-group">
        <label for="subcategory_name" class="block text-lg font-medium text-gray-700">Subcategory Name</label>
        <input type="text" name="subcategory_name" id="subcategory_name" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" value="{{ $subcategory->subcategory_name }}" required>
    </div>

    <!-- Paragraph Input -->
    <div class="form-group">
        <label for="paragraph" class="block text-lg font-medium text-gray-700">Paragraph</label>
        <textarea name="paragraph" id="paragraph" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">{{ $subcategory->paragraph }}</textarea>
    </div>

    <!-- Submit Button -->
    <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md shadow hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">
        Update Subcategory
    </button>
</form>
