<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomepageController extends Controller
{
    public function index(){
        $user = Auth::user(); 
        //get user whose role is user and  associate with current auth user
        $users = User::where('role', 'user')->where('vendor_id', $user->id)->get();
        
        return view('user.welcome',compact('user','users'));
    }
    
        // Display the welcome page
        public function welcome()
        {
            $products = Product::limit('12')->get();
            return view('welcome', compact('products'));
        }
    
        // Display the homepage
        public function homepage()
        {
            $products = Product::limit('12')->get();
            return view('homepage', compact('products'));
        }


        public function impersonate($id)
{
    // Get the currently authenticated user
    $authUser = Auth::user();
    
    // Check if the authenticated user can impersonate the target user
    // You can modify this condition as per your business logic (e.g., checking vendor_id)
    $userToImpersonate = User::findOrFail($id);

    if ( $authUser->id === $userToImpersonate->vendor_id) {
        // Log the authenticated user out first
        Auth::login($userToImpersonate);

        // Optionally, you could store the original user id in the session, so you can switch back later
        session(['impersonating' => $authUser->id]);

        return redirect()->route('user/welcome');  // Redirect to any page you want after switching
    }

    return redirect()->back()->with('error', 'You are not authorized to impersonate this user.');
}

}
