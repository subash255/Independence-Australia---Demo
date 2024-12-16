<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PunchOutController extends Controller
{
    public function fetchCatalog()
    {
        // Send GET request to fetch products from Fake Store API
        $response = Http::get('https://fakestoreapi.com/products');
    
        // Check if the response is successful
        if ($response->successful()) {
            // Parse the JSON response and get product data
            $products = $response->json(); // Automatically converts the JSON response into an array
            return view('punchout.index', compact('products'));
        }
    
        // Return an error message if the request failed
        return view('punchout.index')->with('error', 'Failed to fetch catalog');
    }

    private function createCxmlRequest()
    {
        // Sample CXML request for sandbox environment
        $cxml = '<?xml version="1.0" encoding="UTF-8"?>
        <cXML version="1.2.025" xmlns="http://www.cxml.org/schemas/cxml/1.2.025">
            <Header>
                <From>
                    <Credential domain="DUNS">
                        <Identity>123456789</Identity> <!-- Dummy DUNS number for testing -->
                        <SharedSecret>test_shared_secret</SharedSecret> <!-- Dummy shared secret -->
                    </Credential>
                </From>
                <To>
                    <Credential domain="DUNS">
                        <Identity>987654321</Identity> 
                    </Credential>
                </To>
                <Sender>
                    <Credential domain="DUNS">
                        <Identity>123456789</Identity> 
                        <SharedSecret>test_shared_secret</SharedSecret> <!-- Dummy shared secret -->
                    </Credential>
                    <UserAgent>Test User Agent v1.0</UserAgent> <!-- Example of a dummy user agent -->
                </Sender>
            </Header>
            <Request deploymentMode="production">
                <PunchOutSetupRequest>
                    <BuyerCookie>buyer_cookie_test</BuyerCookie> <!-- Test cookie -->
                    <Extrinsic name="userInfo">test_user_info</Extrinsic> <!-- Example extrinsic data -->
                </PunchOutSetupRequest>
            </Request>
        </cXML>';
    
        return $cxml;
    }

    private function parseCxmlResponse($xml)
    {
        // Turn on libxml error handling
        libxml_use_internal_errors(true);

        // Parse the CXML response and extract product data (use SimpleXML or DOMDocument)
        $xmlObj = simplexml_load_string($xml);

        // If the XML is not valid, log the errors
        if ($xmlObj === false) {
            // Log XML parsing errors
            foreach (libxml_get_errors() as $error) {
                Log::error("XML Error: " . $error->message);
            }
            // Return empty array if parsing fails
            return [];
        }

        $products = [];

        // Assuming the response contains <Item> tags for products
        foreach ($xmlObj->xpath('//Item') as $item) {
            // Handle missing fields with a fallback value
            $products[] = [
                'id' => (string) $item->SupplierPartID ?? 'No ID',  // Add the ID field from XML response
                'name' => (string) $item->Description ?? 'No Description',
                'price' => isset($item->Price[0]->Money->amount) ? (float) $item->Price[0]->Money->amount : 0.0,
                'sku' => (string) $item->SupplierPartID ?? 'No SKU',
            ];
        }

        return $products;
    }
}
