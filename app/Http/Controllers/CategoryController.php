<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str; // Add this import

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(5);
        return view('admin.category.index', compact('categories'), [
            'title' => 'Category'
        ]);
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        // Validate category name and image, but handle slug on client-side
        $data = $request->validate([
            'category_name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:categories,slug',  // Allow slug to be nullable
            'image' => 'required|image',
        ]);

        // Handle the image upload
        $image = time() . '.' . $request->file('image')->getClientOriginalExtension();
        $request->file('image')->move(public_path('images/brand'), $image);
        $data['image'] = $image;
  
        // Create the category
        Category::create($data);
        
        return redirect()->route('admin.category.index')->with('success', 'Category created successfully');
    }
    


    // Show Edit Form
    public function edit($slug)
    {
        $categorys = Category::where('slug',$slug)->firstOrFail();
        $category = Category::findOrFail($categorys->id);
        return view('admin.category.edit', compact('category'), [
            'title' => 'Manage Category'
        ]);
    }

    // Update Category
    public function update(Request $request, $slug)
    {
        $categorys = Category::where('slug',$slug)->firstOrFail();
        $category = Category::findOrFail($categorys->id);

        $request->validate([
            'category_name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories,slug,' . $category->id,
            'image' => 'nullable|image',
        ]);

        $category->category_name = $request->category_name;
        $category->slug = $request->slug;

        if ($request->hasFile('image')) {
            // Delete old image if exists
            $oldImagePath = public_path('images/brand/' . $category->image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }

            // Upload new image
            $image = $request->file('image');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('images/brand'), $imageName);
            $category->image = $imageName;
        }

        $category->save();

        return redirect()->route('admin.category.index')->with('success', 'Category updated successfully');
    }

    // Delete Category
    public function destroy($slug)
    {
        $categorys = Category::where('slug',$slug)->firstOrFail();
        $category = Category::findOrFail($categorys->id);

        // Delete the image
        $imagePath = public_path('images/brand/' . $category->image);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        $category->delete();

        return redirect()->route('admin.category.index')->with('success', 'Category deleted successfully');
    }
    
    public function updateToggleStatus(Request $request, $categoryId)
    {
        // Retrieve the food item by ID from the database
        $category = Category::findOrFail($categoryId);
        
        // Update the status field with the new value
        $category->status = $request->state; // 'state' is 1 (checked) or 0 (unchecked)
        
        // Save the updated food item back to the database
        $category->save();
        
        // Return a JSON response indicating success
        return response()->json(['success' => true]);
    }
}
