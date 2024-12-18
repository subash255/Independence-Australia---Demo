<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'user_id',
        'firstname',
        'lastname',
        'address',
        'contact_info',
        'is_billing',
        'is_shipping',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
