<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    protected $guarded = []; // Allow mass assignment for all attributes

    // Define the relationship with the Category model
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id'); // Foreign key relation
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
