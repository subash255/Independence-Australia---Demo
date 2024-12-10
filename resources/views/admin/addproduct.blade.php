<form action="" method="POST" enctype="multipart/form-data" class="space-y-4">
    @csrf

    <!-- Category Dropdown -->
    <div>
        <label for="category_id" class="block text-gray-600 font-medium">Category</label>
        <select name="category_id" id="category_id"
            class="w-full mt-1 p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option value="" disabled selected>Select a category</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" 
                        data-subcategories="{{ json_encode($category->subcategories) }}">
                    {{ $category->category_name }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Subcategory Dropdown -->
    <div>
        <label for="sub_category_id" class="block text-gray-600 font-medium">Sub-Category</label>
        <select name="sub_category_id" id="sub_category_id"
            class="w-full mt-1 p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option value="" disabled selected>Select a sub-category</option>
        </select>
    </div>

    <!-- Submit Button -->
    <button type="submit"
        class="w-full bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-lg transition">
        Add Product
    </button>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const categorySelect = document.getElementById('category_id');
        const subCategorySelect = document.getElementById('sub_category_id');
        
        categorySelect.addEventListener('change', function() {
            const selectedCategory = categorySelect.options[categorySelect.selectedIndex];
            const subcategories = JSON.parse(selectedCategory.getAttribute('data-subcategories'));

            // Clear current subcategory options
            subCategorySelect.innerHTML = '<option value="" disabled selected>Select a sub-category</option>';

            // Add new subcategory options
            subcategories.forEach(function(subcategory) {
                const option = document.createElement('option');
                option.value = subcategory.id;
                option.textContent = subcategory.subcategory_name;
                subCategorySelect.appendChild(option);
            });
        });
    });
</script>
