<?php

// app/Http/Controllers/BrandController.php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{


    public function index()
    {

            $brands = Brand::paginate(5);
            return view('admin.brand.index', compact('brands'), [
                'title' => 'Brand'
            ]);
    }
    public function create()
    {
        return view('admin.brand.create');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image',
        ]);

        // Handle the image upload
        $image = time() . '.' . $request->file('image')->getClientOriginalExtension();
        $request->file('image')->move(public_path('images/brands'), $image);
        $data['image'] = $image;
  
        // Create the category
        Brand::create($data);

        // Redirect back or to the list of brands
        return redirect()->route('admin.brand.index')->with('success', 'Brand created successfully.');
    }

    public function edit($id)
    {
        $brand = Brand::findOrFail($id);
        return view('admin.brand.edit', compact('brand'), [
            'title' => 'Manage Brand'
        ]);
    }
    public function update(Request $request, $id)
    {
        $brand = Brand::findOrFail($id);
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image',
        ]);
        $brand->name = $request->name;
        // Handle the image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            $oldImagePath = public_path('images/brands/' . $brand->image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }

            // Upload new image
            $image = $request->file('image');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('images/brands'), $imageName);
            $brand->image = $imageName;
        }

        // Update brand record
       $brand->save();

        return redirect()->route('admin.brand.index')->with('success', 'Brand updated successfully.');
    }

    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);
        // Delete the image if it exists
        if ($brand->image) {
            Storage::delete('images/brands/' . $brand->image);
        }

        // Delete the brand record
        $brand->delete();

        return redirect()->route('admin.brand.index')->with('success', 'Brand deleted successfully.');
    }

}

