<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    public function index(){
        $subcategories=Subcategory::paginate(5);
        return view('admin.subcategory.index',compact('subcategories'),[
            'title' => 'Sub Category' 
        ]);
    }
    // Show the form for creating a subcategory
    public function create()
    {
        // Eager load categories with their subcategories
        $categories = Category::all();
        return view('admin.subcategory.addsub', compact('categories'));
    }

    // Store the new subcategory
    public function store(Request $request)
    {
        // Validate the incoming data
        $data = $request->validate([
            'category_id' => 'required|exists:categories,id', // Ensure category exists
            'subcategory_name' => 'required|string|max:255',
            'paragraph' => 'nullable|string',
        ]);

        // Create the subcategory
        Subcategory::create([
            'category_id' => $data['category_id'],
            'subcategory_name' => $data['subcategory_name'],
            'paragraph' => $data['paragraph'],
        ]);

        // Redirect to the addsub page with a success message
        return redirect()->route('admin.subcategory.addsub')->with('success', 'Subcategory created successfully!');
    }
}
