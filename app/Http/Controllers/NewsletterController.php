<?php

namespace App\Http\Controllers;

use App\Mail\Newsletter as MailNewsletter;
use App\Models\Newsletter;
use App\Models\NewsletterEmail;
use Illuminate\Support\Facades\Log;
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

    public function edit($id)
    {
        $newsletter = Newsletter::findOrFail($id);
        return view('admin.newsletter.edit', compact('newsletter'), ['title' => 'Edit Newsletter']);
    }

    public function update(Request $request, $id)
    {
        $newsletter = Newsletter::findOrFail($id);

        $request->validate([
            'subject' => 'required|string|max:255',
            'content' => 'required|string',
            'attachment' => 'nullable|file|image|max:10240', // Optional image attachment
        ]);

        $newsletter->subject = $request->subject;
        $newsletter->content = $request->content;

        if ($request->hasFile('attachment')) {
            // Handle the file upload
            $file = $request->file('attachment');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('attachment'), $filename);
            $newsletter->attachment = $filename;
        }

        $newsletter->save();

        return redirect()->route('admin.newsletter.index')->with('success', 'Newsletter updated successfully');
    }

    public function store(Request $request)
    {
        // Validate the email format only (not uniqueness)
        $request->validate([
            'email' => 'required|email',
        ]);

        // Check if the email already exists in the database
        $existingEmail = NewsletterEmail::where('email', $request->email)->first();

        if ($existingEmail) {
            // If email exists, return with an error message
            return back()->with(['error' => 'This email is already subscribed to our newsletter.']);
        } else {
            // If email does not exist, create a new newsletter entry
            NewsletterEmail::create([
                'email' => $request->email,
            ]);

            // Redirect back with a success message
            return back()->with('success', 'You have been successfully subscribed to our newsletter');
        }
    }

    public function storenewsletter(Request $request)
    {
        $validated = request()->validate([
            'subject' => 'required',
            'content' => 'required',
        ]);

        if ($request->hasFile('attachment') && $request->file('attachment')->isValid()) {
            $attachment = time() . '.' . $request->file('attachment')->getClientOriginalExtension();
            $request->file('attachment')->move(public_path('attachment'), $attachment);
            $validated['attachment'] = $attachment;
        }

        Newsletter::create($validated);

        return redirect()->route('admin.newsletter.index')
            ->with('success', 'Newsletter created successfully!');
    }

    public function subscribers()
    {
        $newsletters = NewsletterEmail::latest()->paginate(10);
        return view('admin.newsletter.subscribers', compact('newsletters'), ['title' => 'Subscribers']);
    }

    public function destroy($id)
    {
        $newsletter = NewsletterEmail::findOrFail($id);
        $newsletter->delete();
        return redirect()->route('admin.newsletter.index')
            ->with('success', 'Subscriber deleted successfully!');
    }

    public function destroynewsletter($id)
    {
        $newsletter = Newsletter::findOrFail($id);
        $newsletter->delete();
        return redirect()->route('admin.newsletter.index')
            ->with('success', 'Newsletter deleted successfully!');
    }

    //   Handle form submission
    public function sendNewsletter(Request $request)
    {
        Log::info('Form submitted', $request->all()); // Log request data
    
        $request->validate([
            'subject' => 'required|string|max:255',
            'content' => 'required|string',
            'attachment' => 'nullable|file|image',
        ]);
    
        // Get all subscribers if "Send to All" is checked
        $subscribers = NewsletterEmail::all();
    
        try {
            foreach ($subscribers as $subscriber) {
                Log::info('Sending email to: ' . $subscriber->email); // Log each email being sent
                Mail::to($subscriber->email)->send(new MailNewsletter($request->subject, $request->content, $request->attachment));
            }
    
            return response()->json([
                'message' => 'Newsletter sent successfully!'
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error sending newsletter: ' . $e->getMessage()); // Log error message
            return response()->json([
                'message' => 'Failed to send newsletter. Please try again.'
            ], 500);
        }
    }
    
}
