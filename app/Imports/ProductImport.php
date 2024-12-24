<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Child_Category;
use App\Models\Subcategory;
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
    
            // Create or find the main category
            $category = Category::firstOrCreate(['name' => $categoryName]);
    
            // Create or find the subcategory
            $subcategory = null;
            if ($subcategoryName) {
                $subcategory = Subcategory::firstOrCreate([
                    'name' => $subcategoryName,
                    'category_id' => $category->id,  // Link to main category
                ]);
            }
    
            // Create or find the child category
            $childCategory = null;
            if ($childCategoryName) {
                $childCategory = Child_Category::firstOrCreate([
                    'name' => $childCategoryName,
                    'subcategory_id' => $subcategory ? $subcategory->id : $category->id,  // Link to subcategory or category
                ]);
            }


        // Check if brand exists in the CSV; if not, set it to null
        $brandName = isset($row['brand']) && !empty($row['brand']) ? $row['brand'] : null;

        // If a brand is provided, find or create it
        $brand = $brandName ? Brand::firstOrCreate(['name' => $brandName]) : null;

        // Create product with relationships
        return new Product([
            'sku' => $row['sku'],
            'name' => $row['name'],
            'short_description' => $row['short_description'],
            'description' => $row['description'],
            'price' => $row['price'],
            'image' => $row['image'],
            'category_id' => $category ? $category->id : null,  
             'brand_id' => $brand ? $brand->id : null,
        ]);
    }
}
