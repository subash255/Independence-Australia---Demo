<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomepageController extends Controller
{
    public function index(){
        $user = Auth::user();
        $categories=Category::with('subcategories')->get(); 
        //get user whose role is user and  associate with current auth user
        $users = User::where('role', 'user')->where('vendor_id', $user->id)->get();
        
        return view('user.welcome',compact('user','users','categories'));
    }
    
        // Display the welcome page
        public function welcome()
        {
            $categories = Category::with('subcategories')->get();
            $products = Product::limit('12')->get();
            return view('welcome', compact('products','categories'));
        }
    
        // Display the homepage
        public function homepage()
        {   $categories=Category::all();
            $products = Product::limit('12')->get();
            return view('homepage', compact('products','categories'));
        }


        public function impersonate($id)
{
    // Get the currently authenticated user
    $authUser = Auth::user();
    
    $userToImpersonate = User::findOrFail($id);

    if ( $authUser->id === $userToImpersonate->vendor_id) {
        
        Auth::login($userToImpersonate);

        // Optionally, you could store the original user id in the session, so you can switch back later
        session(['impersonating' => $authUser->id]);

        return redirect()->route('user.welcome');  
    }

    return redirect()->back()->with('error', 'You are not authorized to impersonate this user.');
}

}
