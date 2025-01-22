<?php

namespace App\Http\Controllers;


use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    // Display all orders
    public function index(Request $request)
    {
        // Get the number of entries per page from the request or default to 5
        $perPage = $request->get('entries', 5);

        // Paginate the orders without any search query
        $orders = Order::paginate($perPage);
        foreach ($orders as $order) {
            $order->shippings = json_encode($order->shipping);
            $order->billings = json_encode($order->billing);
            $orderitems = [];

            $items = $order->line_items;
            $order->total = 0;
            $totalprice = 0;
            foreach ($items as $item) {
                $sku = $item['sku'];
                $product = Product::where('sku', $sku)->first();
                $product->quantity = $item['quantity'];
                $product->total = $product->price * $product->quantity;
                $totalprice += $product->total;
                $orderitems[] = $product;
            }
            $order->product=$product;

            $order->total = $totalprice;

            $order->orderitems = $orderitems;
            // $lineItems=json_decode($order->line_items,true);
        }

        // Return the view with the paginated orders
        return view('admin.order.index', [
            'title' => 'Orders',
            'orders' => $orders
        ]);
    }

    public function view($id)
    {
        // Find the order by ID, or fail with a 404 if not found
        $order = Order::findOrFail($id);
    
        // Decode the billing and shipping data if they are strings
        $billing = is_string($order->billing) ? json_decode($order->billing, true) : $order->billing;
        $shipping = is_string($order->shipping) ? json_decode($order->shipping, true) : $order->shipping;
    
        // Get the order items. Assuming that $order->orderitems is already set up
        $orderitems = $order->orderitems;
    
        // Calculate the total price from line_items (assuming the line_items are stored in the database)
        $order->total = 0;
        $totalPrice = 0;
        $items = $order->line_items; // If this is a relationship, you should fetch it from the model
    
        foreach ($items as $item) {
            $sku = $item['sku'];
            $product = Product::where('sku', $sku)->first();
            
            if ($product) {
                $product->quantity = $item['quantity'];
                $product->total = $product->price * $product->quantity;
                $totalPrice += $product->total;
                $orderitems[] = $product;
            }
        }
    
        // Set the total price for the order
        $order->total = $totalPrice;
    
        // Return the view with the order details
        return view('admin.order.view', compact('order', 'billing', 'shipping', 'orderitems'), [
            'title' => 'Order Details'
        ]);
    }
    



    // Delete a order from the database
    public function destroy($id)
    {
        $order = Order::findOrFail($id);

        // Delete the image file
        Storage::delete('public/orders/' . $order->filename);

        // Delete the order record from the database
        $order->delete();

        return redirect()->route('admin.order.index');
    }
}
