<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Contact;
use App\Models\Text;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function index()
    {
        $sliderTexts = Text::orderBy('priority')->get();
        $categories = Category::with('subcategories')->get();
        // Assuming user is authenticated
        $user = Auth::user();  // Get the entire user object
        $userId = $user->id;
        $users = User::where('role', 'user')
                 ->where('vendor_id', $userId)
                 ->get();
       $shipping = Contact::where('user_id', $userId)->where('is_shipping', '1')->get();
       $billing= Contact::where('user_id', $userId)->where('is_billing', '1')->get();

        return view('user.contact.index', compact('userId' , 'users','sliderTexts','categories' , 'shipping', 'billing'));
    }
    public function address()
    {
        $sliderTexts = Text::orderBy('priority')->get();
        $categories = Category::with('subcategories')->get();
        // Assuming user is authenticated
        $user = Auth::user();  // Get the entire user object
        $userId = $user->id;
        $users = User::where('role', 'user')
                 ->where('vendor_id', $userId)
                 ->get();

        return view('user.contact.address', compact('userId' , 'users','sliderTexts','categories'));
    }

    public function store(Request $request)
    {
        
        // Validate the form data
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'address_1' => 'required|string', 
            'city' => 'required|string',
            'state' => 'required|string',
            'zip' => 'required|string',
            'country' => 'required|string',
            'phone' => 'required|string',
            'contact_info' => 'required|string',
            'is_billing' => 'nullable|in:yes',
            'is_shipping' => 'nullable|in:yes',
        ]);

        // Save the user information in the database
        Contact::create([
            'user_id' => $validated['user_id'],
            'firstname' => $validated['firstname'],
            'lastname' => $validated['lastname'],
            'address_1' => $validated['address_1'],
            'city' => $validated['city'],
            'state' => $validated['state'],
            'zip' => $validated['zip'],
            'country' => $validated['country'],
            'phone' => $validated['phone'],
            'contact_info' => $validated['contact_info'],          
            'is_billing' => $request->has('is_billing') && $request->is_billing == 'yes',
            'is_shipping' => $request->has('is_shipping') && $request->is_shipping == 'yes',
        ]);

        // Return success message
        return redirect('user/contact/index')->with('success', 'Form submitted successfully!');
    }
}
