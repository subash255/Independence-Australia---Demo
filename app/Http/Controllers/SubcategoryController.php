<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    // Show the form to create a new subcategory
    public function create()
    {
        $categories = Category::all(); // Get all categories
        return view('admin.category.addsub', compact('categories'));
    }

    // Store the new subcategory in the database
    public function store(Request $request)
    {
        // Validate the incoming data
       $data= $request->validate([
            'category_id' => 'required|exists:categories,id',
            'subcategory_name' => 'required|string|max:255',
            'paragraph' => 'nullable|string',
        ]);

        // Create the subcategory
        Subcategory::create($data);

        // Redirect to a success page or back to the form
        return redirect()->route('admin.subcategory.create')->with('success', 'Subcategory created successfully!');
    }
}

