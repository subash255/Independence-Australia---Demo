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
        $products = Product::paginate(5);
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
            // Validate the input data
            $data = $request->validate([
                'product_name' => 'required|string|max:255',
                'price' => 'required|numeric|min:0',
                'quantity' => 'required|integer|min:1',
                'description' => 'required|string', // Corrected here
                'brand' => 'required|string|max:255',
                'photopath' => 'nullable|image|max:2048', // Validate image file
                'categories_id' => 'required|exists:categories,id',
                'subcategories_id' => 'required|exists:subcategories,id',
            ]);
        
            // Handle image upload if a file is provided
            if ($request->hasFile('photopath')) {
                // Generate a unique image name and store it in the 'products' folder
                $image = time() . '.' . $request->file('photopath')->getClientOriginalExtension();
                $request->file('photopath')->move(public_path('products'), $image);
                $data['image'] = $image;
                unset($data['photopath']);
            }
        
            // Create the product in the database
            Product::create($data);
        
            // Return a success message and redirect
            return redirect()->route('admin.product.product')->with('success', 'Product added successfully!');
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
