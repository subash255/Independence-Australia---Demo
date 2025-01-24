<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Container\Attributes\Auth as AttributesAuth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Stripe\Checkout\Session;
use Stripe\Stripe;

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

        $user = Auth::user();

        $cartItems = CartItem::where('user_id', $user->id)->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('welcome')->with('error', 'Your cart is empty.');
        }

        $contacts = Contact::where('user_id', $user->id)->get();

        if (!$contacts->count() > 0) {
            return redirect()->route('user.welcome')->with('error', 'No Billing & Shipping Details Found, Please Fill Out The Details.');
        }


        $billingData = null;
        $shippingData = null;
        $bothData = null;
        foreach ($contacts as $contact) {
            if ($contact->is_billing == 1 && $contact->is_shipping == 1) {
                $bothData = [
                    'first_name' => $contact->firstname,
                    'last_name' => $contact->lastname,
                    'address_1' => $contact->address_1,
                    'city' => $contact->city,
                    'state' => $contact->state,
                    'postcode' => $contact->zip,
                    'country' => $contact->country,
                    'email' => $contact->contact_info,
                    'phone' => $contact->phone,
                ];
            } elseif ($contact->is_billing == 1 && $contact->is_shipping == 0) {
                $billingData = [
                    'first_name' => $contact->firstname,
                    'last_name' => $contact->lastname,
                    'address_1' => $contact->address_1,
                    'city' => $contact->city,
                    'state' => $contact->state,
                    'postcode' => $contact->zip,
                    'country' => $contact->country,
                    'email' => $contact->contact_info,
                    'phone' => $contact->phone,
                ];
            } elseif ($contact->is_billing == 0 && $contact->is_shipping == 1) {
                $shippingData = [
                    'first_name' => $contact->firstname,
                    'last_name' => $contact->lastname,
                    'address_1' => $contact->address_1,
                    'city' => $contact->city,
                    'state' => $contact->state,
                    'postcode' => $contact->zip,
                    'country' => $contact->country,
                    'email' => $contact->contact_info,
                    'phone' => $contact->phone,
                ];
            }
        }

        if ($bothData) {
            $billingData = $bothData;
            $shippingData = $bothData;
        } elseif ($billingData) {
            $billingData = $billingData;
        } elseif ($shippingData) {
            $shippingData = $shippingData;
        }


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
        $lineItems = $cartItems->map(function ($item) {
            $product = $item->product;
            return $product ? [
                'sku' => $product->sku,
                'quantity' => $item->quantity,
            ] : null;
        })->filter(function ($item) {
            return !is_null($item);
        });


        $line = $cartItems->map(function ($item) {
            return [
                'sku' => $item->product->sku,
                'quantity' => $item->quantity,
            ];
        });
        // $lineItems = json_decode($line)->toArray();

        $order = Order::create([
            'user_id' => $user->id,
            'billing' => $billingData,
            'shipping' => $shippingData,
            'line_items' => $line,
            'status' => 'pending',
        ]);

        $lineItem = $cartItems->map(function ($item) {
            // For Stripe, convert price to cents (multiply by 100)
            $priceInCents = $item->product->price * 100; // Convert to cents
    
            return [
                'price_data' => [
                    'currency' => 'usd', // The currency of the payment
                    'product_data' => [
                        'name' => $item->product->name, // Product name
                        'description' => $item->product->description, // Product description
                    ],
                    'unit_amount' => $priceInCents, // Price in cents for Stripe
                ],
                'quantity' => $item->quantity, // Quantity of the item
            ];
        });

        // Initialize Stripe client
    Stripe::setApiKey(env('STRIPE_SECRET'));

    // Create the Stripe checkout session
    $session = Session::create([
        'payment_method_types' => ['card'],
        'line_items' => $lineItem->toArray(),
        'mode' => 'payment',
        'success_url' => route('user.success', ['orderId' => $order->id]),
        'cancel_url' => route('user.cancel'),
        'client_reference_id' => $order->id, // To associate the order ID with the session
    ]);

    // Redirect to Stripe Checkout
    return redirect()->to($session->url);
         dd('here');

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
                ['key' => 'submitting_site', 'value' => 'https://testins.com'],
                ['key' => 'po_number', 'value' => 'ABC12348'],
                ['key' => 'order_memo', 'value' => 'Please rush.'],
                ['key' => 'shipping_notes', 'value' => 'Mind the dog.'],
            ],
        ];

        // Convert the data to JSON
        $data = json_encode($data);

        // Initialize cURL


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

        if ($response) {
            // Get the authenticated user's ID
            $user = Auth::id();

            CartItem::where('user_id', $user)->delete();
            return redirect()->route('user.welcome')->with('success', 'Your order has been placed successfully.');
        } elseif ($err) {
            return redirect()->route('user.cart.index')->with('error', 'An error occurred while processing your order.');
        }

        // Close the cURL session
        curl_close($ch);
    }

    public function handleStripeSuccess(Request $request, $orderId)
{
    // Find the order
    $order = Order::find($orderId);

    if ($order && $order->status === 'pending') {
        // Update the order Status to 'success' after payment
        $order->update([
            'status' => 'success',
            
        ]);

        // Optionally, clear the user's cart
        CartItem::where('user_id', Auth::id())->delete();

        // Redirect to a success page with the order details
        return redirect()->route('user.welcome', ['order' => $order->id])->with('success', 'Your payment was successful!');
    }

    return redirect()->route('user.welcome', ['order' => $order->id])->with('error', 'There was an error processing   your payment.');
}

public function handleStripeCancel()
{
    // If the user cancels the payment, redirect them to the cart page with an error message
    return redirect()->route('user.cart')->with('error', 'Payment was cancelled.');
}

}
