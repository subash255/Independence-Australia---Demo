<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(Request $request, $productId)
{
    $user = Auth::user();
    $product = Product::findOrFail($productId);

    // Set quantity to 1 by default
    $quantity = 1;

    // Check if the product is already in the cart
    $cartItem = CartItem::where('user_id', $user->id)
                    ->where('product_id', $productId)
                    ->first();

    if ($cartItem) {
        // If the item exists, update the quantity (just add the new item, no need for manual quantity)
        $cartItem->quantity += $quantity;
        $cartItem->save();
    } else {
        // If the item does not exist, create a new cart item with quantity set to 1
        CartItem::create([
            'user_id' => $user->id,
            'product_id' => $productId,
            'quantity' => $quantity, // Always add 1 to the cart
        ]);
    }

    // Update session cart count
    $cartCount = CartItem::where('user_id', $user->id)->sum('quantity');
    session(['cart_count' => $cartCount]);

    return redirect()->route('welcome');
}

    // View the cart
    public function viewCart()
    {
        $user = Auth::user();
        $categories = Category::with('subcategories')->get();
        $cartItems = CartItem::where('user_id', $user->id)
            ->with('product')
            ->get();

        return view('user.cart.index', compact('cartItems', 'categories'));
    }

    // Update the quantity of a cart item
    public function updateQuantity(Request $request, $cartId)
    {
        // Validate the input quantity
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        // Find the cart item
        $cartItem = CartItem::findOrFail($cartId);

        // Update the quantity
        $cartItem->quantity = $request->quantity;
        $cartItem->save();

        // Update the session cart count
        $cartCount = CartItem::where('user_id', Auth::id())->sum('quantity');
        session(['cart_count' => $cartCount]);

        // Redirect back to the cart page with success message
        return redirect()->route('user.cart.index')->with('success', 'Cart updated successfully!');
    }
}
