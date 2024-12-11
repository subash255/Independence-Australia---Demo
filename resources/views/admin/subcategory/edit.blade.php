<script src="https://cdn.tailwindcss.com"></script>

<form action="{{ route('admin.subcategory.update', $subcategory->id) }}" method="POST" class="max-w-3xl mx-auto p-6 bg-white shadow-lg rounded-lg space-y-6">
    @csrf
    @method('PATCH')

    @if ($errors->any())
    <div class="bg-red-100 text-red-700 p-4 rounded-md">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- Category Dropdown -->
    <div class="form-group">
        <label for="category_id" class="block text-lg font-medium text-gray-700">Category</label>
        <select name="category_id" id="category_id" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id', $subcategory->category_id) == $category->id ? 'selected' : '' }}>
                    {{ $category->category_name }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Subcategory Dropdown -->
    <div class="form-group">
        <label for="subcategory_id" class="block text-lg font-medium text-gray-700">Subcategory</label>
        <select name="subcategory_id" id="subcategory_id" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
            <option value="">Select Subcategory</option>
            @foreach ($subcategories as $sub)
                <option value="{{ $sub->id }}" {{ old('subcategory_id', $subcategory->id) == $sub->id ? 'selected' : '' }}>
                    {{ $sub->subcategory_name }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Subcategory Name Input -->
    <div class="form-group">
        <label for="subcategory_name" class="block text-lg font-medium text-gray-700">Subcategory Name</label>
        <input type="text" name="subcategory_name" id="subcategory_name" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" value="{{ old('subcategory_name', $subcategory->subcategory_name) }}" required>
    </div>

    <!-- Paragraph Input -->
    <div class="form-group">
        <label for="paragraph" class="block text-lg font-medium text-gray-700">Paragraph</label>
        <textarea name="paragraph" id="paragraph" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">{{ old('paragraph', $subcategory->paragraph) }}</textarea>
    </div>

    <!-- Submit Button -->
    <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md shadow hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">
        Update Subcategory
    </button>
</form>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Initial load of subcategories for the selected category
        let categoryId = document.getElementById('category_id').value;
        loadSubcategories(categoryId);

        // Event listener for category change
        document.getElementById('category_id').addEventListener('change', function () {
            let selectedCategoryId = this.value;
            loadSubcategories(selectedCategoryId);
        });

        // Function to load subcategories based on the selected category
        function loadSubcategories(categoryId) {
            if (categoryId) {
                fetch(`/admin/subcategories/${categoryId}`)
                    .then(response => response.json())
                    .then(data => {
                        let subcategorySelect = document.getElementById('subcategory_id');
                        subcategorySelect.innerHTML = '<option value="">Select Subcategory</option>';

                        data.forEach(subcategory => {
                            let option = document.createElement('option');
                            option.value = subcategory.id;
                            option.textContent = subcategory.subcategory_name;
                            subcategorySelect.appendChild(option);
                        });

                        // Set the subcategory dropdown value to the existing subcategory
                        let selectedSubcategoryId = {{ $subcategory->id }};
                        if (selectedSubcategoryId) {
                            subcategorySelect.value = selectedSubcategoryId;
                        }
                    })
                    .catch(error => console.error('Error fetching subcategories:', error));
            } else {
                // If no category selected, clear subcategories
                document.getElementById('subcategory_id').innerHTML = '<option value="">Select Subcategory</option>';
            }
        }
    });
</script>
