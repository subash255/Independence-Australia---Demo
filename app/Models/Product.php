<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded=[];

    public function cartItems()
{
    return $this->hasMany(CartItem::class);
}

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }
    public function childCategory()
    {
        return $this->belongsTo(ChildCategory::class);
    }
    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
   
  
}
