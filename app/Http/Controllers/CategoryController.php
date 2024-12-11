<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(5);
        return view('admin.category.category',compact('categories'),[
            'title' => 'Category' 
        ]);

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
            'slug' => 'required|string|max:255',
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
        return view('admin.category.editcategory', compact('category'));
    }
                                     
    // Update Category
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'category_name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories,slug,' . $category->id,
            'image' => 'nullable|image',
        ]);

        $category->category_name = $request->category_name;
        $category->slug = $request->slug;

        if ($request->hasFile('image')) {
            // Delete old image
            if (Storage::exists(public_path('images/brand'.$category->image))) {
                unlink(public_path('images/brand'.$category->image));
            }

            // Upload new image
            $image = $request->file('image');
            $imageName = time().'.'.$image->extension();
            $image->move(public_path('images/brand'), $imageName);
            $category->image = $imageName;
        }

        $category->update();

        return redirect()->route('admin.category.category')->with('success', 'Category updated successfully');
    }

    // Delete Category
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        // Delete the image
        if (Storage::exists(public_path('images/brand'.$category->image))) {
            unlink(public_path('images/brand'.$category->image));
        }

        $category->delete();

        return redirect()->route('admin.category.category')->with('success', 'Category deleted successfully');
    }
    public function updateToggle(Request $request, $productId)
    {
        $category = Category::find($productId);
    
        if (!$category) {
            return response()->json(['success' => false, 'message' => 'Product not found.']);
        }
    
        // Update the visibility or is_flash field based on the type
        if ($request->type === 'status') {
            $category->status = $request->state;
        } 
    
        $category->save();
    
        return response()->json(['success' => true]);
    }

}
