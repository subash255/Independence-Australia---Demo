<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    protected $fillable = ['subcategory_name', 'paragraph', 'category_id'];
    
    public function categories()
    {
        return $this->belongsTo(Category::class);
    }

}
