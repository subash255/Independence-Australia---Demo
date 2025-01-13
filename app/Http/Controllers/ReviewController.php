<?php

// app/Http/Controllers/ReviewController.php
namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    // Display the review form
    public function create($id)
    {
        $productId = $id;
        return view('review.create', compact('productId'));
    }


    // Store the review
    public function store(Request $request)
    {
        // Validate the input
        $request->validate([
            'email' => 'required|email',
            'message' => 'required|min:10',
            'rating' => 'required|integer|min:1|max:5',
            'product_id' => 'required|exists:products,id',
        ]);

        // Create the review
        Review::create([
            'email' => $request->email,
            'message' => $request->message,
            'rating' => $request->rating,
            'product_id' => $request->product_id,
        ]);

        return redirect()->route('review.create', $request->product_id)
                         ->with('success', 'Review submitted successfully!');
    }

    // Display all reviews for a product
    public function index($id)
    {
        $productId = $id;
        $reviews = Review::where('product_id', $productId)->latest()->get();
        return view('review.index', compact('reviews', 'productId'));
    }
}

