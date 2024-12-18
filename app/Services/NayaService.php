<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class NayaService
    {
        protected $apiUrl;
        protected $apiKey;
    
        public function __construct()
        {
            // Load the API URL and API Key from .env
            $this->apiUrl = env('AEROHEALTH_API_URL');
            $this->apiKey = env('AEROHEALTH_API_KEY');
        }
    
        /**
         * Fetch products from AeroHealthcare API.
         *
         * @return array
         */
        public function fetchProducts()
        {
            // Make the API request with authorization header
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
            ])->get($this->apiUrl);
    
            // Check if the request was successful
            if ($response->successful()) {
                return $response->json(); // Return product data as array
            }
    
            // Handle error if request fails
            return [];
        }
}