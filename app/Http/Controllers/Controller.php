<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function category()
    {
        return view('admin.category.category');
    }
}
