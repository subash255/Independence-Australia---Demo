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
    public function edit($id)
{
    // Find the subcategory by ID or show an error if not found
    $subcategory = Subcategory::findOrFail($id);

    // Fetch categories for the category dropdown list (assuming you need this for the edit form)
    $categories = Category::all();
    $subcategories = Subcategory::where('category_id', $subcategory->category_id)->get(); 

    // Return the view with the subcategory data and categories
    return view('admin.subcategory.edit', compact('subcategory', 'categories','subcategories'));
}

public function getSubcategoriesByCategory($categoryId)
{
    $subcategories = Subcategory::where('category_id', $categoryId)->get();
    return response()->json($subcategories);
}


public function update(Request $request, $id)
{
    // Validate the incoming data
    $data = $request->validate([
        'category_id' => 'required|exists:categories,id', // Ensure category exists
        'subcategory_name' => 'required|string|max:255',
        'paragraph' => 'nullable|string',
    ]);

    // Find the subcategory by ID or fail
    $subcategory = Subcategory::findOrFail($id);

    // Update the subcategory with the validated data
    $subcategory->category_id = $data['category_id'];
    $subcategory->subcategory_name = $data['subcategory_name'];
    $subcategory->paragraph = $data['paragraph'];

    // Save the updated subcategory to the database
    $subcategory->save();

    // Redirect back with a success message
    return redirect()->route('admin.subcategory.index')->with('success', 'Subcategory updated successfully!');
}



public function destroy($id)
{
    // Find the subcategory by ID or fail
    $subcategory = Subcategory::findOrFail($id);

    // Delete the subcategory
    $subcategory->delete();

    // Redirect to the addsub page with a success message
    return redirect()->route('admin.subcategory.addsub')->with('success', 'Subcategory deleted successfully!');
}

    
}
