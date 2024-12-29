<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use App\Models\Text;
use App\Models\User;
use Illuminate\Container\Attributes\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB as FacadesDB;

class HomepageController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $sliderTexts = Text::orderBy('priority')->get();
        $images = Banner::orderBy('priority','asc')->get();
        $categories = Category::with('subcategories')->get();
        //get user whose role is user and  associate with current auth user
        $users = User::where('role', 'user')->where('vendor_id', $user->id)->get();

        return view('user.welcome', compact('user', 'users', 'categories', 'images', 'sliderTexts'));
    }
    public function welcome()
    {
        $user = Auth::user();
        $sliderTexts = Text::orderBy('priority')->get();
        $images = Banner::orderBy('priority', 'asc')->get();
        $products = Product::limit(12)->get();
        $categories = Category::all();
        // Check if the user is authenticated before accessing its properties
        if ($user && $user->role == 'vendor') {
            $users = User::where('role', 'user')->where('vendor_id', $user->id)->get();
        } else {
            $users = collect();
        }

        return view('welcome', compact('products', 'users', 'categories', 'images', 'sliderTexts'));
    }

    // Display the homepage
    public function homepage()
    {
        $categories = Category::all();

        $products = Product::limit('12')->get();
        return view('homepage', compact('products', 'categories'));
    }

    public function showcat($id)
    {
        // Fetch categories for the sidebar
        $categories = Category::with('subcategories')->get();
    
        // Fetch the selected category (using the categoryId passed in the URL)
        $category = Category::with(['products', 'subcategories'])->findOrFail($id);

        $subcategories = FacadesDB::table('subcategories')
    ->where('category_id', $id)
    ->get();

    $products = FacadesDB::table('products')
    ->where('category_id', $id)
    ->get();
        
        // Fetch the products belonging to this category
        $products = Product::where('category_id', $id)->get();
    
        // Slider texts or any other necessary data
        $sliderTexts = Text::orderBy('priority')->get();
    
        // Return the view with necessary data
        return view('menu.index', compact('category', 'categories', 'sliderTexts', 'products' , 'subcategories'));
    }
    


    public function showproduct($id)
    {
        $categories = Category::with('subcategories')->get();
        $sliderTexts = Text::orderBy('priority')->get();
        $product = Product::findOrFail($id); // Fetch product by ID
        return view('product.show', compact('product', 'sliderTexts', 'categories'));
    }

    public function impersonate($id)
    {
        // Get the currently authenticated user
        $authUser = Auth::user();

        $userToImpersonate = User::findOrFail($id);
        
        if ($authUser->id === $userToImpersonate->vendor_id) {
            
            Auth::login($userToImpersonate);

            // Optionally, you could store the original user id in the session, so you can switch back later
            session(['impersonating' => $authUser->id]);

            return redirect()->route('user.welcome');
        }

        return redirect()->back()->with('error', 'You are not authorized to impersonate this user.');
    }
    public function stopImpersonation()
{
    // Get the original user ID from the session
    $originalUserId = session('impersonating');

    if ($originalUserId) {
        // Find the original user
        $originalUser = User::findOrFail($originalUserId);

        // Log in as the original user
        Auth::login($originalUser);

        // Clear the impersonation session
        session()->forget('impersonating');

        return redirect()->route('user.welcome');  // Redirect to wherever you need after switching back
    }

    // Return an error if no impersonation session exists
    return redirect()->back()->with('error', 'You are not impersonating any user.');
}

}
