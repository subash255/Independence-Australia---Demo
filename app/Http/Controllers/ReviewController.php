<?php

// app/Http/Controllers/ReviewController.php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function adminindex()
    {
        $reviews = Review::paginate(10);
        return view('admin.reviews.index', compact('reviews'), ['title' => 'Reviews']);
    }

    // Store the review
    public function store(Request $request)
    {

        // Validate the input
        $request->validate([
            'message' => 'required',
            'rating' => 'required|numeric|min:1|max:5',
            'product_id' => 'required|exists:products,id',



        ]);



        // Create the review
        Review::create([
            'message' => $request->message,
            'rating' => $request->rating,
            'product_id' => $request->product_id,
            'user_id' => Auth::user()->id,
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

    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();
        return redirect()->route('admin.reviews.index')
            ->with('success', 'Review deleted successfully!');
    }

    public function updateToggleStatus(Request $request, $reviewId)
    {
        // Retrieve the review by ID from the database
        $review = Review::findOrFail($reviewId);

        // Update the status field with the new value
        $review->status = $request->state; // 'state' is 1 (checked) or 0 (unchecked)

        // Save the updated review back to the database
        $review->save();

        // Return a JSON response indicating success
        return response()->json(['success' => true]);
    }
}
