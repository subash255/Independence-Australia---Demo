<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Order;
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
    // Get the authenticated user
    $user = Auth::user();
    
    // Get the user's cart details
    $cartItems = CartItem::where('user_id', $user->id)->with('product')->get();

    if ($cartItems->isEmpty()) {
        return redirect()->route('welcome')->with('error', 'Your cart is empty.');
    }
dd($cartItems);
    // Get the user's contact details
    $contact = Contact::where('user_id', $user->id)->first();

    if (!$contact) {
        return redirect()->route('welcome')->with('error', 'No contact information found.');
    }

    if ($contact->is_billing == 0) {
        return redirect()->route('welcome')->with('error', 'Billing information is required.');
    }

    if ($contact->is_shipping == 0) {
        return redirect()->route('welcome')->with('warning', 'Do you want the billing and shipping address to be the same?');
    }
    
    
    // Validate the request
    $useSameAddress = $request->input('same_address', false);
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
        'shipping.first_name' => $useSameAddress ? 'nullable' : 'required|string|max:255',
        'shipping.last_name' => $useSameAddress ? 'nullable' : 'required|string|max:255',
        'shipping.address_1' => $useSameAddress ? 'nullable' : 'required|string|max:255',
        'shipping.city' => $useSameAddress ? 'nullable' : 'required|string|max:255',
        'shipping.state' => $useSameAddress ? 'nullable' : 'required|string|max:255',
        'shipping.postcode' => $useSameAddress ? 'nullable' : 'required|string|max:255',
        'shipping.country' => $useSameAddress ? 'nullable' : 'required|string|max:255',
    ]);
   

    // Prepare billing and shipping data from Contact table
    $billingData = [
        'first_name' => $contact->firstname,
        'last_name' => $contact->lastname,
        'address_1' => $contact->address,
        'city' => $contact->city,
        'state' => $contact->state,
        'postcode' => $contact->zip,
        'country' => $contact->country,
        'email' => $contact->contact_info,
        'phone' => $contact->phone,
    ];

    // If shipping address is the same as billing, use billing data, otherwise use validated shipping data
    $shippingData = $useSameAddress ? $billingData : $validated['shipping'];

    // Prepare line items for the API request
    $lineItems = $cartItems->map(function ($item) {
        $product = $item->product;
        return $product ? [
            'sku' => $product->sku,
            'quantity' => $item->quantity,
        ] : null;
    })->filter(function ($item) {
        return !is_null($item);
    });

    // Store the order in the database
    $order = Order::create([
        'user_id' => $user->id,
        'billing' => json_encode($billingData),  // Encode the billing data as JSON
        'shipping' => json_encode($shippingData),  // Encode the shipping data as JSON
        'line_items' => json_encode($lineItems->toArray()),  // Encode line items as JSON
        'status' => 'pending', // Example status
    ]);

    // Now, send the order to the external API
    $apiKey = env('AEROHEALTH_API_KEY');
    $apiSecret = env('AEROHEALTH_API_SECRET');
    $base64Credentials = base64_encode("{$apiKey}:{$apiSecret}");
    $url = 'https://aerohealthcareonline.com/wp-json/aero-api/v3/orders';

    // Prepare the data for the API request
    $data = [
        'billing' => $billingData,
        'shipping' => $shippingData,
        'line_items' => $lineItems->toArray(),
        'meta_data' => [
            ['key' => 'submitting_site_order_id', 'value' => $order->id],
            ['key' => 'submitting_site', 'value' => 'https://example.com'],
            ['key' => 'po_number', 'value' => 'ABC1234'],
            ['key' => 'order_memo', 'value' => 'Please rush.'],
            ['key' => 'shipping_notes', 'value' => 'Mind the dog.'],
        ],
    ];

    // Convert the data to JSON
    $jsonData = json_encode($data);

    // Send data to external API using HTTP client (Laravel's Http facade)
    try {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Basic ' . $base64Credentials,
        ])->post($url, $jsonData);

        // Check if the request was successful
        if ($response->successful()) {
            return redirect()->route('checkout.success')->with('success', 'Your order has been successfully placed and processed.');
        } else {
            Log::error('API request failed', [
                'status' => $response->status(),
                'response' => $response->body(),
            ]);
            return redirect()->route('checkout')->with('error', 'There was an issue processing your order.');
        }
    } catch (\Exception $e) {
        Log::error('Error communicating with API', ['exception' => $e->getMessage()]);
        return redirect()->route('checkout')->with('error', 'An error occurred while communicating with the API.');
    }
}

    
    
}
