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
                ['key' => 'submitting_site_order_id', 'value' => '123'],
                ['key' => 'submitting_site', 'value' => 'https://exampled.com'],
                ['key' => 'po_number', 'value' => 'ABC1234'],
                ['key' => 'order_memo', 'value' => 'Please rushs.'],
                ['key' => 'shipping_notes', 'value' => 'Mind the doog.'],
            ],
        ];

        // convert shipping_notes to JSON
        $data = json_encode($data);
       
         // Base64 encode the API credentials
    $apiKey = env('AEROHEALTH_API_KEY');
    $apiSecret = env('AEROHEALTH_API_SECRET');
    $base64Credentials = base64_encode("{$apiKey}:{$apiSecret}");

        // Convert the line_items and meta_data to JSON
        // $data['line_items'] = json_encode($data['line_items']);
        // $data['meta_data'] = json_encode($data['meta_data']);
        // dd($data);
    

    // API URL to send the POST request to
    $url = 'https://aerohealthcareonline.com/wp-json/aero-api/v3/orders';

    // Initialize cURL session
    $ch = curl_init();

    // Set cURL options
    curl_setopt($ch, CURLOPT_URL, $url); // Set the target URL
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the response as a string
    curl_setopt($ch, CURLOPT_POST, true); // Specify that it's a POST request
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data); // Attach the data (encoded as JSON)
    
    // Set headers
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization:  Basic {Y2tfdGttYXJmYnJDQzRsQXByYk5wSWJrbHdqbndRSTJrSkw6Y3NfU25BMkhXYlVtWE04U1U1WGpoNnY0WE4yQUoxamFad3o=}',
        'User-Agent: YourAppName/1.0', // Set a custom user-agent
        'Referer: https://yourwebsite.com', // Set the referrer (the website from where the request originates)
    ]);

    // Execute the cURL request and capture the response
    $response = curl_exec($ch);

    // Get any cURL errors
    $err = curl_error($ch);

    // Close the cURL session
    curl_close($ch);
    dd('here',$response , $err);
        
        try {
            // Send the data to the external API
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Basic ' . $base64Credentials,
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
