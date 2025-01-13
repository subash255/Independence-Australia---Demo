<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{

    public function index()
    {
        $newsletters = Newsletter::latest()->paginate(10);
        return view('admin.newsletter.index', compact('newsletters'), ['title' => 'Newsletter']);
    }

    public function store(Request $request)
{
    // Validate the email format only (not uniqueness)
    $request->validate([
        'email' => 'required|email',
    ]);

    // Check if the email already exists in the database
    $existingEmail = Newsletter::where('email', $request->email)->first();

    if ($existingEmail) {
        // If email exists, return with an error message
        return back()->with(['error' => 'This email is already subscribed to our newsletter.']);
    } else {
        // If email does not exist, create a new newsletter entry
        Newsletter::create([
            'email' => $request->email,
        ]);

        // Redirect back with a success message
        return back()->with('success', 'You have been successfully subscribed to our newsletter');
    }
}

    public function destroy($id)
    {
        $newsletter = Newsletter::findOrFail($id);
        $newsletter->delete();
        return redirect()->route('admin.newsletter.index')
                         ->with('success', 'Newsletter deleted successfully!');
    }
}
