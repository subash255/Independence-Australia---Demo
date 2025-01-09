<?php

namespace App\Http\Controllers;

use App\Models\Logo;
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
            $order->line_items = $order->line_items;
            $items = $order->line_items;
            $order->total = 0;
            $sku = $items['sku'];
            $product = Product::where('sku', $sku)->first();
            $order->total += $product->price * $items['quantity'];
            $order->product = $product;
        }


        // Return the view with the paginated orders
        return view('admin.order.index', [
            'title' => 'Orders',
            'orders' => $orders
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

        return redirect()->route('admin.orders.index');
    }
}
