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
    $categories = Category::with('subcategories')->get();
    $category = Category::with(['products', 'subcategories'])->findOrFail($id);

    // Fetch subcategories for the category
    $subcategories = FacadesDB::table('subcategories')
        ->where('category_id', $id)
        ->get();

    // Fetch products for the category
    $productsQuery = Product::where('category_id', $id);

    // Get the selected sort option from the request, default to 'name_asc'
    $sortBy = request('sort_by', 'name_asc');

    // Apply sorting based on the selected option
    switch ($sortBy) {
        case 'name_asc':
            $productsQuery = $productsQuery->orderBy('name', 'asc');
            break;
        case 'name_desc':
            $productsQuery = $productsQuery->orderBy('name', 'desc');
            break;
        case 'price_asc':
            $productsQuery = $productsQuery->orderBy('price', 'asc');
            break;
        case 'price_desc':
            $productsQuery = $productsQuery->orderBy('price', 'desc');
            break;
        case 'rating_asc':
            $productsQuery = $productsQuery->orderBy('rating', 'asc');
            break;
        case 'rating_desc':
            $productsQuery = $productsQuery->orderBy('rating', 'desc');
            break;
        default:
            $productsQuery = $productsQuery->orderBy('name', 'asc'); // Default sorting by name ascending
            break;
    }

    // Paginate the products, showing 15 per page
    $products = $productsQuery->paginate(15);

    // Fetch the slider texts or any other necessary data
    $sliderTexts = Text::orderBy('priority')->get();

    // Return the view with the necessary data
    return view('menu.index', compact('category', 'categories', 'sliderTexts', 'products', 'subcategories'));
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

public function search(Request $request)
{
    $query = $request->input('query');
    
    if ($query) {
        // Perform the search using the query
        $products = Product::where('name', 'like', "%$query%")->take(6)->get();

        // HTML output for the grid
        $output = '<div class="grid grid-cols-3 gap-9">';
        
        if ($products->count()) {
            foreach ($products as $product) {
               
                $imagePath = asset( $product->image);

                $output .= '<div class="product-item bg-white p-6 border rounded-lg shadow-md">';
                $output .= '<img src="' . $imagePath . '" alt="' . $product->name . '" class="w-full h-20 object-cover rounded-lg mb-4">';
                $output .= '<h3 class="text-sm font-semibold">' . $product->name . '</h3>';
                $output .= '</div>';
            }
        } else {
            $output .= '<p class="col-span-3">No products found.</p>';
        }

        $output .= '</div>'; // End the grid container

        return response()->json($output);
    }

    return response()->json(['message' => 'No query provided.']);
}


}
