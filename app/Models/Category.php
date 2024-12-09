<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['category_name', 'image'];
    protected $table = 'category';

    public function subcategories()
    {
        return $this->hasMany(Subcategory::class);
    }
}
