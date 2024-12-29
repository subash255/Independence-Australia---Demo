<?php

namespace App\Imports;


use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\ChildCategory;
use App\Models\Subcategory;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Split the category, subcategory, and child category
        $categoriesPath = explode(' > ', $row['category']);  // Format: Category > Subcategory > Child Category
        
        // Get category, subcategory, and child category names
        $categoryName = $categoriesPath[0] ?? null;
        $subcategoryName = $categoriesPath[1] ?? null;
        $childCategoryName = $categoriesPath[2] ?? null;

        // Create or find the main category with its slug
        $category = Category::firstOrCreate(
            ['name' => $categoryName],
            ['slug' => Str::slug($categoryName)]  // Create slug from category name
        );

        // Create or find the subcategory with its slug
        $subcategory = null;
        if ($subcategoryName) {
            // First, check if the subcategory exists within the same category
            $subcategory = Subcategory::where('name', $subcategoryName)
                ->where('category_id', $category->id)
                ->first();

            if (!$subcategory) {
                // If the subcategory doesn't exist, create it
                $slug = Str::slug($subcategoryName);
                $slug = $this->getUniqueSlug('subcategories', $slug);  // Ensure the slug is unique
                $subcategory = Subcategory::create([
                    'name' => $subcategoryName,
                    'category_id' => $category->id,
                    'slug' => $slug,
                ]);
            }
        }

        // Create or find the child category with its slug
        $childCategory = null;
        if ($childCategoryName) {
            $childCategory = ChildCategory::firstOrCreate(
                ['name' => $childCategoryName, 'subcategory_id' => $subcategory ? $subcategory->id : $category->id],  // Link to subcategory or category
                ['slug' => Str::slug($childCategoryName)]  // Create slug from child category name
            );
        }

        // Check if brand exists in the CSV; if not, set it to null
        $brandName = isset($row['brand']) && !empty($row['brand']) ? $row['brand'] : null;

        // If a brand is provided, find or create it
        $brand = $brandName ? Brand::firstOrCreate(['name' => $brandName]) : null;

        // Create product with relationships, and slug for the product
        $slug = Str::slug($row['name']);

        // Ensure the product slug is unique
        $slug = $this->getUniqueSlug('products', $slug);

        return new Product([
            'sku' => $row['sku'],
            'name' => $row['name'],
            'slug' => $slug,  // Generate unique slug for product
            'short_description' => $row['short_description'],
            'description' => $row['description'],
            'price' => $row['price'],
            'image' => $row['image'],
            'category_id' => $category ? $category->id : null, 
            'subcategory_id' => $subcategory ? $subcategory->id : null,
            'child_category_id' => $childCategory ? $childCategory->id : null, 
            'brand_id' => $brand ? $brand->id : null,
        ]);
    }

    // Helper function to generate a unique slug by checking if the slug exists in a specific table
    private function getUniqueSlug($table, $slug)
{
    // Convert table name to the corresponding singular model class
    // Example: 'subcategories' table maps to 'Subcategory' model
    $modelClass = '\\App\\Models\\' . ucfirst(Str::singular($table));  // Convert table name to singular form and capitalize

    // Check if the model exists before using it
    if (!class_exists($modelClass)) {
        throw new \Exception("Model class {$modelClass} not found.");
    }

    // Query the model class to check if the slug already exists
    $existingRecord = $modelClass::where('slug', $slug)->first();

    if ($existingRecord) {
        // If the slug exists, append a number to make it unique
        $count = 1;
        $newSlug = $slug . '-' . $count;
        while ($modelClass::where('slug', $newSlug)->exists()) {
            $count++;
            $newSlug = $slug . '-' . $count;
        }
        return $newSlug;
    }

    // Return the original slug if it's unique
    return $slug;
}
}

