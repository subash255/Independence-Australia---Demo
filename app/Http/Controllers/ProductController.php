<?php

namespace App\Http\Controllers;

use App\Imports\ProductImport;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // $status = $request->get('status');  


        // $products = Product::when($status, function ($query) use ($status) {
        //     return $query->where('status', $status);  // Filter by status
        // })
        // ->paginate(5);

        $entries = $request->get('entries', 15);

        $products = Product::paginate($entries);
        return view('admin.product.index', compact('products'), [
            'title' => 'Product'
        ]);
    }

    public function create()
    {
        $categories = Category::with('subcategories')->get();

        return view('admin.product.create', compact('categories'));
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

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.product.show', compact('product'), [
            'title' => 'Product Details'
        ]);
    }



    public function store(Request $request)
    {
        // Validate the input data
        $request->validate([
            'csv_file' => 'required|mimes:xlsx,csv,txt'
        ]);


        // Import the CSV file
        Excel::import(new ProductImport, $request->file('csv_file'));

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

        $ordersWithProduct = Order::whereJsonContains('line_items', ['sku' => $product->sku])->exists();

        if ($ordersWithProduct) {
            // If the product is part of an order, do not allow deletion
            return redirect()->back()->with('error', 'This product is already part of an order and cannot be deleted.');
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

    public function updateToggleStatus(Request $request, $productId)
    {
        // Retrieve the food item by ID from the database
        $product = Product::findOrFail($productId);

        // Update the status field with the new value
        $product->status = $request->state; // 'state' is 1 (checked) or 0 (unchecked)

        // Save the updated food item back to the database
        $product->save();

        // Return a JSON response indicating success
        return response()->json(['success' => true]);
    }
}
