<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.category',compact('categories'));

    }
    public function create()
    {
        return view('admin.category.addcategory');
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $data = $request->validate([
            'category_name' => 'required|string|max:255',
            'image' => 'required|image',
        ]);

        
        $image = time() . '.' . $request->file('image')->getClientOriginalExtension();
        $request->file('image')->move(public_path('images/brand'), $image);
        $data['image'] = $image;

        Category::create($data);
       
        

        return redirect()->route('admin.category.category')->with('success', 'Category created successfully');
    }


    // Show Edit Form
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.edit', compact('category'));
    }

    // Update Category
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'category_name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $category->category_name = $request->category_name;

        if ($request->hasFile('image')) {
            // Delete old image
            if (Storage::exists(public_path('images/'.$category->image))) {
                unlink(public_path('images/'.$category->image));
            }

            // Upload new image
            $image = $request->file('image');
            $imageName = time().'.'.$image->extension();
            $image->move(public_path('images'), $imageName);
            $category->image = $imageName;
        }

        $category->save();

        return redirect()->route('categories.index')->with('success', 'Category updated successfully');
    }

    // Delete Category
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        // Delete the image
        if (Storage::exists(public_path('images/'.$category->image))) {
            unlink(public_path('images/'.$category->image));
        }

        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully');
    }

}
