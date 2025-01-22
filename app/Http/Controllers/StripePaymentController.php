<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\PaymentIntent;
use Stripe\Stripe;
use Stripe\Exception\ApiErrorException;

class StripePaymentController extends Controller
{
    public function __construct()
    {
        // Set the secret Stripe API key
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    }

    public function createPaymentIntent(Request $request)
    {
        // Total amount should be in cents (multiply by 100)
        $total = (int)($request->total * 100);  // Stripe expects amount in cents

        try {
            // Create the PaymentIntent
            $paymentIntent = PaymentIntent::create([
                'amount' => $total,
                'currency' => 'usd',
            ]);

            return response()->json([
                'clientSecret' => $paymentIntent->client_secret
            ]);
        } catch (ApiErrorException $e) {
            // Catch Stripe API errors and return a response with the error message
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
