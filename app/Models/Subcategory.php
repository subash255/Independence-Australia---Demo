<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    protected $fillable = ['subcategory_name', 'paragraph', 'categories_id'];
    
    public function categories()
    {
        return $this->belongsTo(Category::class);
    }

}
