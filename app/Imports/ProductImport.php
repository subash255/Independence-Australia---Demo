<?php

namespace App\Imports;

use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductImport implements ToModel, WithHeadingRow

{
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {        $category = Category::find($row['categories_id']);
        $subcategory = Subcategory::find($row['subcategories_id']);
        return new Product([
            'product_name' => $row['product_name'],
            'image' => $row['image'],
            'description' => $row['description'],
            'price' => $row['price'],
            'quantity' => $row['quantity'],
            'brand' => $row['brand'],
            'remark' => $row['remark'],
            'status' => $row['status'],
            'categories_id' => $category ? $category->id : null, // If category found, set its ID, otherwise null
            'subcategories_id' => $subcategory ? $subcategory->id : null,
            'brands_id' => $row['brands_id'],
            'visibility' => $row['visibility'],
            'is_flash' => $row['is_flash'],

        ]);
    }
}