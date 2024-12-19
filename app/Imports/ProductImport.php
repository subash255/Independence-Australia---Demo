<?php

namespace App\Imports;

use App\Models\Product;
use Illuminate\Support\Collection;
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
       
        return new Product([
            'sKU' => $row['sku'],  // Check if SKU is set, otherwise st
            'name' => $row['name'],  // Check if Name is set, otherwise st
            'short_description' => $row['short_description'],  // Check if Short_Description is set, otherwise st
  // Check if Description is set, otherwise st
            'price' => $row['price'],  // Check if Price is set, otherwise st
            'brand' => $row['brand'],  // Check if Brand is set, otherwise st
            'image' => $row['image'],  // Check if Image is set, otherwise st
            'category' => $row['category'] 
            

        ]);
    }
}