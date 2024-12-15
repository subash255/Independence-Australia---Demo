<?php

// Fake Store Fetcher
// namespace App\Services;

// use App\Models\Product;
// use GuzzleHttp\Client;
// use App\Models\Test;

// class TestFetcher
// {
//     protected $client;

//     public function __construct()
//     {
//         $this->client = new Client();
//     }

//     public function fetchTests()
//     {
//         $response = $this->client->get('https://fakestoreapi.com/products');

//         // Decode the JSON response
//         $tests = json_decode($response->getBody()->getContents(), true);

//         // Store each test in the database
//         foreach ($tests as $test) {
//             test::updateOrCreate(
//                 ['title' => $test['title']], // Using title as the unique identifier
//                 [
//                     'description' => $test['description'],
//                     'price' => $test['price'],
//                     'category' => $test['category'],
//                     'image' => $test['image']
//                 ]
//             );
//         }
//     }
// }


//Ebay Fetcher
// namespace App\Services;

// use GuzzleHttp\Client;

// class TestFetcher
// {
//     protected $client;
//     protected $appId;

//     public function __construct()
//     {
//         $this->client = new Client();
//         $this->appId = env('EBAY_APP_ID'); // Store your eBay App ID in the .env file
//     }

//     public function fetchTests($keywords)
//     {
//         $url = "https://api.sandbox.ebay.com/ws/api.dll";
        
//         // Example eBay API request
//         $response = $this->client->request('GET', $url, [
//             'query' => [
//                 'callname' => 'FindItemsByKeywords',
//                 'keywords' => $keywords,
//                 'siteid' => 0,  // eBay site (0 for the US)
//                 'version' => 967,
//                 'appid' => $this->appId
//             ]
//         ]);

//         $products = simplexml_load_string($response->getBody()->getContents());
//         return $products;
//     }
// }

//Shopify Fetcher
// namespace App\Services;

// use GuzzleHttp\Client;

// class TestFetcher
// {
//     protected $client;
//     protected $apiKey;
//     protected $password;
//     protected $shopUrl;

//     public function __construct()
//     {
//         $this->client = new Client();
//         $this->shopUrl = env('SHOPIFY_STORE_URL');
//         $this->apiKey = env('SHOPIFY_API_KEY');
//         $this->password = env('SHOPIFY_PASSWORD');
//     }

//     public function fetchTests()
//     {
//         $url = "https://{$this->shopUrl}/admin/api/2023-10/products.json";

//         $response = $this->client->request('GET', $url, [
//             'auth' => [$this->apiKey, $this->password]
//         ]);

//         $tests = json_decode($response->getBody()->getContents(), true);
//         return $tests['products'];
//     }
// }

//DummyJson
namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Models\Test;

class TestFetcher
{
    public function fetchAndStoreTests()
    {
        // Fetch the product data from DummyJSON API
        $response = Http::get('https://dummyjson.com/products');
    
        // Check if the API response is successful
        if ($response->successful()) {
            $tests = $response->json()['products'];
    
            // Loop through the products and store them in the database
            foreach ($tests as $test) {
    
                // Ensure that the image URL is properly set
                $imageUrl = isset($test['images'][0]) ? $test['images'][0] : '';
    
                // Update or create the product record in the database
                Test::updateOrCreate(
                    ['id' => $test['id']],
                    [
                        'title' => $test['title'],
                        'price' => $test['price'],
                        'description' => $test['description'],
                        'category' => $test['category'],
                        'image' => $imageUrl,  // Storing the first image URL
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                );
            }
        }
    }
}    
