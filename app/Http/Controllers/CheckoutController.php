<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class CheckoutController extends Controller
{
    // Show the checkout page with cart items
    public function showCheckoutPage()
    {
        $user = Auth::user();
        $cartItems = CartItem::where('user_id', $user->id)->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('welcome')->with('error', 'Your cart is empty.');
        }

        return view('checkout', compact('cartItems'));
    }

    // Process the checkout by redirecting to another website (AeroHealth API)
    public function processCheckout(Request $request)
    {
        // Get the user's cart details
        $user = Auth::user();
        $cartItems = CartItem::where('user_id', $user->id)->with('product')->get();

        // Check if the cart is empty
        if ($cartItems->isEmpty()) {
            return redirect()->route('welcome')->with('error', 'Your cart is empty.');
        }

        // Prepare data to send to AeroHealth API
        $cartData = [
            'user_id' => $user->id,
            'user_name' => $user->name,
            'user_email' => $user->email,
            'cart_id' => $cartItems->pluck('id')->toArray(),
            'product_ids' => $cartItems->pluck('product_id')->toArray(),
            'quantities' => $cartItems->pluck('quantity')->toArray(),
            'product_details' => $cartItems->map(function ($cartItem) {
                return [
                    'product_id' => $cartItem->product_id,
                    'product_name' => $cartItem->product->name,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->product->price,
                ];
            })->toArray(),
        ];

        // Send data to AeroHealth API
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('AEROHEALTH_API_KEY'),
            ])->post(env('AEROHEALTH_API_URL'), $cartData);

            // Check the API response status
            if ($response->successful()) {
                // Handle success, e.g., redirect the user to a success page
                return redirect()->route('/')->with('success', 'Your order has been processed successfully.');
            } else {
                // Handle failure (API error)
                return redirect()->route('user.welcome')->with('error', 'There was an issue processing your order.');
            }
        } catch (\Exception $e) {
            // Handle any other errors (e.g., network issues)
            return redirect()->route('user.cart.index')->with('error', 'An error occurred while communicating with the API.');
        }
    }
}
