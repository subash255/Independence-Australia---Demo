<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->get('status');  // Get the status from the query parameter

    // Fetch products based on the status if provided, otherwise, fetch all products
    $products = Product::when($status, function ($query) use ($status) {
        return $query->where('status', $status);  // Filter by status
    })
    ->paginate(5);
        return view('admin.product.index',compact('products'), [
            'title' => 'Product' 
        ]);

    }

    public function create()
    {
        $categories = Category::with('subcategories')->get();  // Fetch all categories
        
        return view('admin.product.create',compact('categories'));
    }

    public function getSubCategories($categoryId)
    {
        $subCategories = Subcategory::where('category_id', $categoryId)->get(); // Correct foreign key
        return response()->json($subCategories);
    }

    
        public function edit($id)
        {
            $product = Product::find($id);
            return view('admin.product.edit', compact('product'));
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
            return redirect()->route('admin.product.index')->with('success', 'Product added successfully!');
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
            return redirect()->route('admin.product.index')->with('error', 'Product not found.');
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
    
        return redirect()->route('admin.product.index')->with('success', 'Product updated successfully.');
    }
    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return redirect()->route('admin.product.index')->with('error', 'Product not found.');
        }
        $product->delete();
        return redirect()->route('admin.product.index')->with('success', 'Product deleted successfully.');
    }
    public function updateToggle(Request $request, $productId)
{
    $product = Product::find($productId);

    if (!$product) {
        return response()->json(['success' => false, 'message' => 'Product not found.']);
    }

    // Update the visibility or is_flash field based on the type
    if ($request->type === 'visibility') {
        $product->visibility = $request->state;
    } elseif ($request->type === 'is_flash') {
        $product->is_flash = $request->state;
    }

    $product->save();

    return response()->json(['success' => true]);
}

// ProductController.php

public function updateStatus(Request $request, $id)
{
    // Find the product by ID or fail if not found
    $product = Product::findOrFail($id);

    // Ensure the status is only updated if it's still 'pending'
    if ($product->status != 'pending') {
        return response()->json([
            'success' => false, 
            'message' => 'Product status cannot be changed as it is not pending.'
        ]);
    }

    // Validate incoming data (status and remarks)
    $request->validate([
        'status' => 'required|in:approved,rejected',
        'remark' => 'required|string|max:255',
    ]);

    // Update the product's status and remark
    $product->status = $request->status;
    $product->remark = $request->remark;
    $product->save();

    // Return the updated data
    return response()->json([
        'success' => true, 
        'message' => 'Product status updated successfully.',
        'status' => $product->status,
        'remark' => $product->remark
    ]);
}




}
