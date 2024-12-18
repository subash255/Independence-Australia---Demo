<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomepageController extends Controller
{
    public function index(){
        $user = Auth::user();  
        return view('user.welcome',compact('user'));
    }

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
