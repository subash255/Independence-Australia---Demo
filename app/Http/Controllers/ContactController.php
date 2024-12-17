<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        // Assuming user is authenticated
        // $userId = auth()->User()->id; 

        // return view('user-form', compact('userId'));
    }

    public function store(Request $request)
    {
        // Validate the form data
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'address' => 'required|string',
            'contact_info' => 'required|string',
            'is_billing' => 'required|in:yes,no',
            'is_shipping' => 'required|in:yes,no',
        ]);

        // Save the user information in the database
        Contact::create([
            'user_id' => $validated['user_id'],
            'firstname' => $validated['firstname'],
            'lastname' => $validated['lastname'],
            'address' => $validated['address'],
            'contact_info' => $validated['contact_info'],
            'is_billing' => $validated['is_billing'],
            'is_shipping' => $validated['is_shipping'],
        ]);

        // Return success message
        return back()->with('success', 'Form submitted successfully!');
    }
}
