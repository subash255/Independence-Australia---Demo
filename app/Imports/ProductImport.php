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
            'SKU' => $row['SKU'],  // Check if SKU is set, otherwise st
            'Name' => $row['Name'],  // Check if Name is set, otherwise st
            'Short_Description' => $row['Short_Description'],  // Check if Short_Description is set, otherwise st
  // Check if Description is set, otherwise st
            'Price' => $row['Price'],  // Check if Price is set, otherwise st
            'Brand' => $row['Brand'],  // Check if Brand is set, otherwise st
            'Image' => $row['Image'],  // Check if Image is set, otherwise st
            'Category' => $row['Category'] 
            

        ]);
    }
}