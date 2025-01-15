<?php

namespace App\Http\Controllers;

use App\Mail\Newsletter as MailNewsletter;
use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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

    public function subscribers()
    {
        $newsletters = Newsletter::latest()->paginate(10);
        return view('admin.newsletter.subscribers', compact('newsletters'), ['title' => 'Subscribers']);
    }

    public function destroy($id)
    {
        $newsletter = Newsletter::findOrFail($id);
        $newsletter->delete();
        return redirect()->route('admin.newsletter.index')
            ->with('success', 'Newsletter deleted successfully!');
    }

  // Handle form submission
  public function sendNewsletter(Request $request)
  {
      // Validate form data
      $request->validate([
          'subject' => 'required|string|max:255',
          'content' => 'required|string',
        //   'send_to_all' => 'nullable|boolean',
      ]);

      // Get all subscribers if "Send to All" is checked
      $subscribers = Newsletter::all();

      try {
          // Send the newsletter email to all subscribers
          foreach ($subscribers as $subscriber) {
              Mail::to($subscriber->email)->send(new MailNewsletter($request->subject, $request->content));
          }

          // Return success response
          return response()->json([
              'message' => 'Newsletter sent successfully!'
          ], 200);

      } catch (\Exception $e) {
          // Return error response in case of failure
          return response()->json([
              'message' => 'Failed to send newsletter. Please try again.'
          ], 500);
      }
  }
}
