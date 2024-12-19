<?php

namespace App\Imports;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductImport implements ToModel, WithHeadingRow
{
    /**
     * Handle the import of each row.
     *
     * @param array $row
     * @return Product|null
     */
    public function model(array $row)
{
    // Log the row data to check if it's being processed correctly
    Log::info('Row data:', $row);

    $category = Category::find($row['categories_id']);
    $subcategory = Subcategory::find($row['subcategories_id']);
    $brand = Brand::find($row['brands_id']);

    // Log the category, subcategory, and brand for validation
    Log::info('Category:', [$category ? $category->name : 'Not Found']);
    Log::info('Subcategory:', [$subcategory ? $subcategory->name : 'Not Found']);
    Log::info('Brand:', [$brand ? $brand->name : 'Not Found']);

    // If any of the relationships are invalid, log and skip
    if (!$category || !$subcategory || !$brand) {
        Log::warning('Skipping product due to invalid foreign key', $row);
        return null;
    }

    // Log before saving the product to check data before insert
    Log::info('Inserting product:', [
        'product_name' => $row['product_name'],
        'price' => $row['price'],
        'quantity' => $row['quantity'],
    ]);

    return new Product([
        'product_name' => $row['product_name'],
        'image' => $row['image'],
        'description' => $row['description'],
        'price' => $row['price'],
        'quantity' => $row['quantity'],
        'brand' => $row['brand'],
        'remark' => $row['remark'],
        'visibility' => $row['visibility'],
        'is_flash' => $row['is_flash'],
        'status' => $row['status'],
        'categories_id' => $row['categories_id'],
        'subcategories_id' => $row['subcategories_id'],
        'brands_id' => $row['brands_id'],
    ]);
}
}