<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomepageController extends Controller
{

        private function getProducts()
        {
            return Product::where('visibility', 1) 
                ->orderBy('created_at', 'desc')
                ->paginate(12); 
        }
    
        // Display the welcome page
        public function welcome()
        {
            $products = $this->getProducts(); // Get products for the welcome page
            return view('welcome', compact('products'));
        }
    
        // Display the homepage
        public function homepage()
        {
            $products = $this->getProducts(); // Get products for the homepage
            return view('homepage', compact('products'));
        }

}
