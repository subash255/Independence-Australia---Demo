<?php

namespace App\Imports;

use App\Models\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductImport implements ToModel, WithHeadingRow

{
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {     
       
        return new Product([
            'sku' => $row['SKU'],  // Check if SKU is set, otherwise st
            'name' => $row['Name'],  // Check if Name is set, otherwise st
            'short_description' => $row['Short_Description'],  // Check if Short_Description is set, otherwise st
  // Check if Description is set, otherwise st
            'price' => $row['Price'],  // Check if Price is set, otherwise st
            'brand' => $row['Brand'],  // Check if Brand is set, otherwise st
            'image' => $row['Image'],  // Check if Image is set, otherwise st
            'category' => $row['Category'] 
            

        ]);
    }
}