<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('id')->get();
        return view('admin.product.product',compact('products'), [
            'title' => 'Product' 
        ]);

    }
    public function create()
    {
        $categories = Category::with('subcategories')->get();  // Fetch all categories
        
        return view('admin.addproduct',compact('categories'));
    }
    public function getSubCategories($categoryId)
    {
        $subCategories = Subcategory::where('category_id', $categoryId)->get(); // Correct foreign key
        return response()->json($subCategories);
    }

    
        public function edit($id)
        {
            $product = Product::find($id);
            return view('admin.edit', compact('product'));
        }
        
    
    public function store(Request $request)
{
    $data = $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
        'quantity' => 'required|integer|min:1',
        'brand' => 'required|string|max:255',
        'photopath' => 'nullable|image|max:2048', // Validate image file
    ]);

    if ($request->hasFile('photopath')) {
        // Handle image upload
        $image = time() . '.' . $request->file('photopath')->getClientOriginalExtension();
        $request->file('photopath')->move(public_path('products'), $image);
        $data['image'] = $image;
        unset($data['photopath']);
    }

    Product::create($data);

    return redirect()->route('product.create')->with('success', 'Product added successfully!');
}


public function update(Request $request, $id)
{
        
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
            'brand' => 'required|string|max:255',
            'photopath' => 'nullable|image|max:2048',   
        ]);
    
        $product = Product::find($id);
        if (!$product) {
            return redirect()->route('admin.product')->with('error', 'Product not found.');
        }
    
        $data = $request->all();
    
        if ($request->hasFile('photopath')) {
            // Handle image upload
            $image = time() . '.' . $request->file('photopath')->getClientOriginalExtension();
            $request->file('photopath')->move(public_path('products'), $image);
            $data['image'] = $image;
            unset($data['photopath']);
        }
    
        $product->update($data);
    
        return redirect()->route('admin.product')->with('success', 'Product updated successfully.');
    }
    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return redirect()->route('admin.product')->with('error', 'Product not found.');
        }
        $product->delete();
        return redirect()->route('admin.product')->with('success', 'Product deleted successfully.');
    }


}
