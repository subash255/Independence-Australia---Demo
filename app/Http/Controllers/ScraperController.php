<?php

namespace App\Http\Controllers;

use App\Models\Sajilo;
use Illuminate\Http\Request;

class ScraperController extends Controller
{
    public function scrapeProducts()
    {
        // The URL to scrape
        $url = 'https://fakestoreapi.com/products';  // Replace with the actual website URL

        // Initialize cURL
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);  // Follow redirects if any
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0'); // Set a user-agent to simulate a browser
        $html = curl_exec($ch);
        curl_close($ch);

        // Check if the request was successful
        if (!$html) {
            return response()->json(['error' => 'Failed to retrieve content'], 500);
        }

        // Parse the HTML content using DOMDocument
        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);  // Suppress warnings for invalid HTML
        $dom->loadHTML($html);
        libxml_clear_errors();

        // Use DOMXPath to navigate and extract data from the HTML
        $xpath = new \DOMXPath($dom);

        // Extract product data (adjust selectors based on actual HTML structure)
        $products = [];
        $productNodes = $xpath->query('//div[contains(@class, "product")]');  // Replace with the correct selector

        foreach ($productNodes as $node) {
            $name = $xpath->query('.//span[contains(@class, "product-name")]', $node)->item(0)->nodeValue ?? 'N/A';
            $price = $xpath->query('.//span[contains(@class, "product-price")]', $node)->item(0)->nodeValue ?? 'N/A';
            $url = $xpath->query('.//a', $node)->item(0)->getAttribute('href') ?? '';

            $products[] = [
                'name' => $name,
                'price' => $price,
                'url' => $url,
            ];

            // Optionally, store the products in the database
            Sajilo::create([
                'name' => $name,
                'price' => $price,
                'url' => $url,
            ]);
        }

        // Return the extracted products as a JSON response
        return response()->json($products);
    }
}
