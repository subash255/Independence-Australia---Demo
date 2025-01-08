<?php

namespace App\Http\Controllers;

use App\Models\Logo;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LogoController extends Controller
{
    // Display all logos
    public function index(Request $request)
    {
        // Get the number of entries per page from the request or default to 5
        $perPage = $request->get('entries', 5);
        
        // Paginate the orders without any search query
        $orders = Order::paginate($perPage);
        
        // Decode the 'items' JSON column for each order
        // foreach ($orders as $order) {
        //     $order->items = json_decode($order->line_items, true); 
        //     $order->billings = json_decode($order->billing, true);  // Decode the 'items' JSON column
        // }
       
        
        
        // Return the view with the paginated orders
        return view('admin.logos.index', [
            'title' => 'Orders',
            'orders' => $orders
        ]);
    }

    // Show the form to create a new logo
    public function create()
    {
        return view('admin.logos.create');
    }

    // Store a newly uploaded logo in the database
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif',
            'position' => 'required|string',
        ]);

        // Handle the logo upload
        $image = time() . '.' . $request->file('logo')->getClientOriginalExtension();
        $request->file('logo')->move(public_path('logos'), $image);

        // Save the logo to the database
        Logo::create([
            'position' => $request->input('position'),
            'filename' => $image,
        ]);

        return redirect()->route('admin.logos.index');
    }

    // Show the form to edit an existing logo
    public function edit($id)
    {
        $logo = Logo::findOrFail($id);
        return view('admin.logos.edit', compact('logo'));
    }

    // Update an existing logo in the database
    public function update(Request $request, $id)
    {
        // Validate the incoming request
        $request->validate([
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'position' => 'required|string',
        ]);

        $logo = Logo::findOrFail($id);

        // If a new image is uploaded, handle it
        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('public/logos', $imageName);

            // Delete the old image
            Storage::delete('public/logos/' . $logo->filename);

            // Update the filename with the new image name
            $logo->filename = $imageName;
        }

        // Update the position
        $logo->position = $request->input('position');
        $logo->save();

        return redirect()->route('admin.logos.index');
    }

    // Delete a logo from the database
    public function destroy($id)
    {
        $logo = Logo::findOrFail($id);

        // Delete the image file
        Storage::delete('public/logos/' . $logo->filename);

        // Delete the logo record from the database
        $logo->delete();

        return redirect()->route('admin.logos.index');
    }
}
