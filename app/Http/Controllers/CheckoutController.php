<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    // Show the checkout page with cart items
    public function showCheckoutPage()
    {
        $categories = Category::with('subcategories')->get();
        $user = Auth::user();
        $cartItems = CartItem::where('user_id', $user->id)->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('welcome')->with('error', 'Your cart is empty.');
        }

        return view('checkout', compact('cartItems', 'categories'));
    }
    public function show()
    {
        $user = Auth::user();
        $cartItems = CartItem::where('user_id', $user->id)->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('welcome')->with('error', 'Your cart is empty.');
        }

        return view('user.cart.show', compact('cartItems'));
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
        $validated = $request->validate([
            'billing.first_name' => 'required|string|max:255',
            'billing.last_name' => 'required|string|max:255',
            'billing.address_1' => 'required|string|max:255',
            'billing.city' => 'required|string|max:255',
            'billing.state' => 'required|string|max:255',
            'billing.postcode' => 'required|string|max:255',
            'billing.country' => 'required|string|max:255',
            'billing.email' => 'required|email|max:255',
            'billing.phone' => 'required|string|max:255',
            'shipping.first_name' => 'required|string|max:255',
            'shipping.last_name' => 'required|string|max:255',
            'shipping.address_1' => 'required|string|max:255',
            'shipping.city' => 'required|string|max:255',
            'shipping.state' => 'required|string|max:255',
            'shipping.postcode' => 'required|string|max:255',
            'shipping.country' => 'required|string|max:255',
        ]);
        
        // Create an array of line items dynamically using the product_id and quantity from the cart
        $lineItems = $cartItems->map(function ($item) {
            // Fetch SKU based on product_id
            $product = $item->product; // We already have the product loaded using 'with('product')'
    
            // Check if product exists
            if ($product) {
                return [
                    'sku' => $product->sku, // Get SKU from Product model
                    'quantity' => $item->quantity, // Get quantity from the cart
                ];
            }
    
            return null; // If the product is not found, we return null (you could handle this case differently)
        })->filter(); // Remove any null values if a product wasn't found
    
        // Prepare the data for the API request
        $data = [
            'billing' => $validated['billing'],
            'shipping' => $validated['shipping'],
            'line_items' => $lineItems->toArray(), // Convert to array
            'meta_data' => [
                ['key' => 'submitting_site_order_id', 'value' => '12345'],
                ['key' => 'submitting_site', 'value' => 'http://127.0.0.1:8000'],
                ['key' => 'po_number', 'value' => 'ABC123'],
                ['key' => 'order_memo', 'value' => 'Please rush.'],
                ['key' => 'shipping_notes', 'value' => 'Mind the dog.'],
            ],
        ];

        // convert shipping_notes to JSON
        $data = json_encode($data);
        // dd($data);

        // Convert the line_items and meta_data to JSON
        // $data['line_items'] = json_encode($data['line_items']);
        // $data['meta_data'] = json_encode($data['meta_data']);
        // dd($data);
    
        
        try {
            // Send the data to the external API
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Basic {Y2tfMjV3UDdSU3lKRmpsaHhoaFZURVhxUVB4OVZxVVByZFM6Y3Nfb01Tc3BNSnc4RkF0UWJUMXN6bnROQVg2QmlzUmhYbWg=}',
            ])->post('https://aerohealthcareonline.com/wp-json/aero-api/v3/orders', $data);
    
            // Check if the request was successful
            if ($response->successful()) {
                dd('success',$response);
                return redirect()->route('user/welcome')->with('success', 'Your order has been processed successfully.');
            } else {
                dd('error',$response->body());
                Log::error('API request failed', [
                    'status' => $response->status(),
                    'response' => $response->body(),
                ]);
                return redirect()->route('user/cart/show')->with('error', 'There was an issue processing your order.');
            }
        } catch (\Exception $e) {
            // Log the exception for debugging
            Log::error('Error communicating with API', ['exception' => $e->getMessage()]);
            return redirect()->route('checkout')->with('error', 'An error occurred while communicating with the API.');
        }
    }
    
}
