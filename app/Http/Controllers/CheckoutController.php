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
            return redirect()->route('welcome')->with('error', 'No contact information found.');
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
            }elseif ($contact->is_billing == 1 && $contact->is_shipping == 0) {
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

            }elseif($contact->is_billing == 0 && $contact->is_shipping == 1){
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

        if($bothData){
            $billingData = $bothData;
            $shippingData = $bothData;
        }elseif($billingData){
            $billingData = $billingData;
        }elseif($shippingData){
            $shippingData = $shippingData;
        }

        
        // Prepare line items for the API request
        // $lineItems = $cartItems->map(function ($item) {
        //     $product = $item->product;
        //     return $product ? [
        //         'sku' => $product->sku,
        //         'quantity' => $item->quantity,
        //     ] : null;
        // })->filter(function ($item) {
        //     return !is_null($item);
        // });

        // $line = json_decode($lineItems);
        $line = $cartItems->map(function ($item) {
            return [
                'sku' => $item->product->sku,
                'quantity' => $item->quantity,
            ];
            
        });
    
        $order = Order::create([
            'user_id' => $user->id,
            'billing' => $billingData,
            'shipping' => $shippingData,
            'line_items' => $line,
            'status' => 'pending',
        ]);
    
        dd('done on local');
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
        
            // If you're storing cart items in session, clear them from session
            session()->forget('cart.' . $user);  // This assumes cart items are stored in the session with the user's ID as the key.
        
            // Alternatively, if you use a different method to store cart items in the session, adjust this line accordingly.
        
            // Redirect back with success message
            return redirect()->route('user.welcome')->with('success', 'Your order has been placed successfully.');
        }
        
        elseif($err){
            return redirect()->route('user.cart.index')->with('error', 'An error occurred while processing your order.');
        }
    
        // Close the cURL session
        curl_close($ch);
    }
    

    
    
}