<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'billing',
        'shipping',
        'line_items',
        'meta_data',
        'status',
    ];

    // Cast JSON fields
    protected $casts = [
        'billing' => 'array',
        'shipping' => 'array',
        'line_items' => 'array',
        'meta_data' => 'array',
    ];

    // Get the user that owns the order
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
