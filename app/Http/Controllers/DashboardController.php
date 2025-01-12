<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{

    

public function index()
{
    
    $totalvisits = Visit::sum('number_of_visits');
    $date = \Carbon\Carbon::today()->subDays(30);
    $visitdate = Visit::where('visit_date', '>=', $date)->pluck('visit_date');
    $visits = Visit::where('visit_date', '>=', $date)->pluck('number_of_visits');
    $categories = Category::withCount('products')->get();
    $categoryLabels = [];
    $categoryData = [];
    
    foreach ($categories as $category) {
        $categoryLabels[] = $category->name;  // Category name
        $categoryData[] = $category->products_count;  // Product count
    }
    
    // Fetch orders grouped by day for the line chart
    $orders = Order::selectRaw('DATE(created_at) as order_date, COUNT(*) as total_orders')
                   ->groupBy('order_date')
                   ->orderBy('order_date', 'asc') // Ensure chronological order
                   ->get();
    
    $orderLabels = [];
    $orderData = [];
    
    foreach ($orders as $order) {
        $orderLabels[] = Carbon::parse($order->order_date)->format('Y-m-d');  // Date formatted as Y-m-d
        $orderData[] = $order->total_orders;  // Order count for that day
    }
    $order=Order::count();
    $pendingorder=Order::where('status','pending')->count();
    $completedorder=Order::where('status','completed')->count();

    
    // Passing all the data to the view
    return view('admin.dash', [
        'title' => 'Dashboard',
        'categories' => $categories, // Category data for pie chart
        'categoryLabels' => $categoryLabels,
        'categoryData' => $categoryData,
        'orderLabels' => $orderLabels,
        'orderData' => $orderData,
        'totalvisits' => $totalvisits,
        'visitdate' => $visitdate,
        'visits' => $visits,
        'totalorder'=>$order,
        'pendingorder'=>$pendingorder,
        'completedorder'=>$completedorder
    ]);
}

    public function product()
    {
        return view('admin.product.product', [
            'title' => 'Product'
        ]);
    }

    public function category()
    {
        return view('admin.category', [
            'title' => 'Category'
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $validated['image'] = $path;
        }

        Product::create($validated);

        return redirect()->route('product.create')->with('success', 'Product added successfully!');
    }
}
