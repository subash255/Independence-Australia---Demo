<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use App\Models\Subcategory;
use App\Models\Text;
use App\Models\User;
use App\Models\Visit;
use Illuminate\Container\Attributes\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\Session;

class HomepageController extends Controller
{
    public function index()
    {
        // Get the currently authenticated user
        $user = Auth::user();

        // Get slider texts ordered by priority
        $sliderTexts = Text::orderBy('priority')->get();

        // Get banner images ordered by priority
        $images = Banner::orderBy('priority', 'asc')->get();

        // Fetch categories along with subcategories
        $categories = Category::with('subcategories')->get();

        // Get the current user's ID
        $userId = $user->id;

        // Get users associated with the current user's vendor ID
        $users = User::where('role', 'user')->where('vendor_id', $userId)->get();

        // Fetch shipping contact for the current user
        $shipping = Contact::where('user_id', $userId)->where('is_shipping', '1')->first();

        // Fetch billing contact for the current user
        $billing = Contact::where('user_id', $userId)->where('is_billing', '1')->first();

        // Pass the data to the view
        return view('user.welcome', compact('user', 'users', 'categories', 'images', 'sliderTexts', 'shipping', 'billing'));
    }

    public function welcome()
    {
        $this->visits();
        $user = Auth::user();
        
        $sliderTexts = Text::orderBy('priority')->get();
        $images = Banner::orderBy('priority', 'asc')->get();
        $products = Product::limit(20)->get();
        $reviews = [];
        foreach ($products as $product) {
            // Get reviews for this particular product
            $reviews[$product->id] = Review::where('product_id', $product->id)->get();
        }
        $categories = Category::all();
        // Check if the user is authenticated before accessing its properties
        if ($user && $user->role == 'vendor') {
            $users = User::where('role', 'user')->where('vendor_id', $user->id)->get();
        } else {
            $users = collect();
        }

        return view('welcome', compact('products', 'users', 'categories', 'images', 'sliderTexts', 'reviews'));
    }

    // Display the homepage
    public function homepage()
    {
        $categories = Category::all();

        $products = Product::limit('20')->get();
        return view('homepage', compact('products', 'categories'));
    }

    public function order()
    {
        $user = Auth::user();  // Get the authenticated user
        $sliderTexts = Text::orderBy('priority')->get();  // Fetch slider texts for the page
        $images = Banner::orderBy('priority', 'asc')->get();  // Fetch banner images
        $categories = Category::all();  // Fetch all categories

        // Check if the user is authenticated
        if ($user) {
            if ($user->role == 'vendor') {
                // Fetch orders for users managed by the vendor
                $users = User::where('role', 'user')->where('vendor_id', $user->id)->get();
                $orders = Order::whereIn('user_id', $users->pluck('id'))->get();  // Fetch orders for users under this vendor
            } else {
                // Fetch orders for the authenticated user (regular user)
                $orders = Order::where('user_id', $user->id)->get();
                $users = collect();  // No users for regular customers
            }
        } else {
            $orders = collect();  // No orders if the user is not authenticated
            $users = collect();  // No users if the user is not authenticated
        }

        // Process the orders if available
        foreach ($orders as $order) {
            $order->shippings = json_encode($order->shipping);
            $order->billings = json_encode($order->billing);
            $orderitems = [];

            $totalprice = 0;

            // Loop through the line items (which are stored as JSON in the 'line_items' field)
            foreach ($order->line_items as $item) {
                // Fetch the product by SKU (or other identifier, based on your data structure)
                $product = Product::where('sku', $item['sku'])->first();  // Assuming 'sku' is the identifier for the product

                if ($product) {
                    // Calculate the product total based on quantity
                    $product->quantity = $item['quantity'];
                    $product->total = $product->price * $product->quantity;

                    // Add the product to the order items array
                    $orderitems[] = $product;

                    // Update the total price for the order
                    $totalprice += $product->total;
                }
            }

            $order->total = $totalprice;
            $order->orderitems = $orderitems;
        }

        // Pass the data to the view
        return view('user.myorder', compact('orders', 'users', 'categories', 'images', 'sliderTexts'));
    }





    public function showcat(Request $request, $slug)
    {
        // If no slug is provided, redirect or handle the case accordingly
    
        // Retrieve the category using the slug if it is provided
        $cat = Category::where('slug', $slug)->first(); // Find category by slug
    
        // Get the category with products and subcategories
        $categories = Category::with(['products', 'subcategories'])->get();

    
        // Fetch subcategories for the category
        $subcategories = Subcategory::where('category_id', $cat->id)->get();
    
        // Fetch products related to the category
        $products = Product::where('category_id', $cat->id)->get();
    
        // Get all unique brand_ids from the products
        $brandIds = $products->pluck('brand_id')->unique();
    
        // Get the full brand objects using the brand IDs
        $brands = Brand::whereIn('id', $brandIds)->get();
    
        // Get the selected brand from the request (single brand ID)
        $selectedBrand = $request->input('brand');
    
        // Get the sorting option from the request
        $sortBy = $request->input('sort_by', 'name_asc');
    
        // Start the products query for the selected category
        $productsQuery = Product::where('category_id', $cat->id);
    
        // Apply brand filter if a brand is selected
        if ($selectedBrand) {
            $productsQuery = $productsQuery->where('brand_id', $selectedBrand);
        }
    
        // Apply sorting based on the selected sort option
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
            case 'review_asc':
                $productsQuery = $productsQuery->orderBy('review', 'asc');
                break;
            case 'review_desc':
                $productsQuery = $productsQuery->orderBy('review', 'desc');
                break;
            default:
                $productsQuery = $productsQuery->orderBy('name', 'asc'); // Default sorting by name ascending
                break;
        }
    
        // Paginate the products
        $products = $productsQuery->paginate(15);
    
        // Return the view with all necessary data
        return view('menu.index', compact('cat', 'categories', 'products', 'subcategories', 'brands', 'selectedBrand', 'sortBy'));
    }

    public function subcat(Request $request, $categoryslug, $slug)
{
    
    $category = Category::where('slug', $categoryslug)->firstOrFail();

    $categories = Category::with('subcategories')->get();
    
    // Retrieve the subcategory within the specified category using the subcategory slug
    $subcategory = Subcategory::where('slug', $slug)
                               ->where('category_id', $category->id)  // Use $category->id, not $categories->id
                               ->firstOrFail(); // Find subcategory by slug and category_id
    
    // Initialize the products query
    $productsQuery = Product::where('subcategory_id', $subcategory->id);
    
    // Handle sorting and filtering
    $selectedBrand = $request->input('brand');
    $sortBy = $request->input('sort_by', 'name_asc');
    
    // Apply brand filter if selected
    if ($selectedBrand) {
        $productsQuery->where('brand_id', $selectedBrand);
    }

    // Apply sorting based on the selected sort option
    switch ($sortBy) {
        case 'name_asc':
            $productsQuery->orderBy('name', 'asc');
            break;
        case 'name_desc':
            $productsQuery->orderBy('name', 'desc');
            break;
        case 'price_asc':
            $productsQuery->orderBy('price', 'asc');
            break;
        case 'price_desc':
            $productsQuery->orderBy('price', 'desc');
            break;
        case 'rating_asc':
            $productsQuery->orderBy('rating', 'asc');
            break;
        case 'rating_desc':
            $productsQuery->orderBy('rating', 'desc');
            break;
        default:
            $productsQuery->orderBy('name', 'asc'); // Default sorting by name ascending
            break;
    }
    
    // Fetch products with pagination
    $products = $productsQuery->paginate(15);

    // Get all unique brands related to the products in the subcategory
    $brands = Brand::whereIn('id', $products->pluck('brand_id')->unique())->get();
    
    // Return the view with all necessary data
    return view('menu.subcat', compact('subcategory', 'products', 'brands', 'categories', 'selectedBrand', 'sortBy'));
}



    

    
    


    public function allproduct(Request $request)
    {
        // Fetch categories and brands
        $categories = Category::with('subcategories')->get();
        $brands = Brand::all();
        
        // Handle sorting and filtering
        $selectedBrand = $request->input('brand');
        $sortBy = $request->input('sort_by', 'name_asc');
        
        // Initialize the products query
        $productsQuery = Product::query();
        
        // Handle search query
        $query = $request->input('query'); // Get the search query from request
        if ($query) {
            // Filter products by search query (name)
            $productsQuery->where('name', 'like', '%' . $query . '%');
        }
    
        // Filter products by selected brand
        if ($selectedBrand) {
            $productsQuery->where('brand_id', $selectedBrand);
        }

        // Apply sorting based on the selected sort option
        switch ($sortBy) {
            case 'name_asc':
                $productsQuery->orderBy('name', 'asc');
                break;
            case 'name_desc':
                $productsQuery->orderBy('name', 'desc');
                break;
            case 'price_asc':
                $productsQuery->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $productsQuery->orderBy('price', 'desc');
                break;
            case 'rating_asc':
                $productsQuery->orderBy('rating', 'asc');
                break;
            case 'rating_desc':
                $productsQuery->orderBy('rating', 'desc');
                break;
            default:
                $productsQuery->orderBy('name', 'asc'); // Default sorting by name ascending
                break;
        }
        
        // Paginate the products
        $products = $productsQuery->paginate(15);
        
        // Check if the request is AJAX
        if ($request->ajax()) {
            // Return a JSON response with the paginated products and additional information for pagination
            return response()->json([
                'products' => $products->items(), // Send only the items on the current page
                'next_page_url' => $products->nextPageUrl(), // URL for the next page
            ]);
        }
        
        // Return the view with products, categories, and subcategories
        return view('product.index', compact('products', 'categories', 'brands', 'selectedBrand', 'sortBy', 'query'));
    }
    
    public function showproduct($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        $reviews = Review::where('product_id', $product->id)->get();
        $relatedProducts = Product::where('category_id', $product->category_id)->where('id', '!=', $product->id)->limit(4)->get();
        return view('product.show', compact('product', 'reviews', 'relatedProducts'));
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

                    $imagePath = asset($product->image);

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

    //visited people
    public function visits()
{
    if (!Session::has('visit')) {

        $last_date = Visit::latest('visit_date')->first();
        $visit_date = date('Y-m-d');
        if ($last_date) {
            if ($last_date->visit_date != $visit_date) {
                $number_of_visits = 1;
                $d = new Visit();
                $d->visit_date = $visit_date;
                $d->number_of_visits = $number_of_visits;
                $d->save();
            } else {
                $newvisit = $last_date->number_of_visits + 1;
                Visit::where('visit_date', $visit_date)->update(['number_of_visits' => $newvisit]);
            }
        } else {
            $number_of_visits = 1;
            $d = new Visit();
            $d->visit_date = $visit_date;
            $d->number_of_visits = $number_of_visits;
            $d->save();
        }
        Session::put('visit', 'yes');
        Session::save();
    }
}
}