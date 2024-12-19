<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded=[];

    public function category()
    {
        return $this->belongsTo(Category::class, 'categories_id'); // Foreign key relation
    }
    public function subcategory()
    {
        return $this->belongsTo(subcategory::class, 'subcategories_id'); // Foreign key relation
    }
    public function brand()
{
    return $this->belongsTo(Brand::class, 'brands_id');
}
}
