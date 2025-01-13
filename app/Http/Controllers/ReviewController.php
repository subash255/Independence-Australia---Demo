<?php

// app/Http/Controllers/ReviewController.php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    // Display the review form
    public function create($id)
    {
        $product = Product::findOrFail($id);
        return view('review.create', compact('product'));
    }


    // Store the review
    public function store(Request $request)
    {
        
        // Validate the input
        $request->validate([
            'email' => 'required|email',
            'message' => 'required',
            'rating' => 'required|numeric|min:1|max:5',
            'product_id' => 'required|exists:products,id',

            
            
        ]);
        
        

        // Create the review
        Review::create([
            'email' => $request->email,
            'message' => $request->message,
            'rating' => $request->rating,
            'product_id' => $request->product_id,
        ]);

        return redirect()->route('product.show', $request->product_id)
                         ->with('success', 'Review submitted successfully!');
    }

    // Display all reviews for a product
    public function index($id)
    {
        $product = $id;
        $reviews = Review::where('product_id', $product)->latest()->get();
        return view('review.index', compact('reviews', 'product'));
    }
}

