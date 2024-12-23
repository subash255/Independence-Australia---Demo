<?php

namespace App\Http\Controllers;

use App\Models\Text;
use Illuminate\Http\Request;

class TextController extends Controller
{
     // Display a listing of the banners
     public function index()
     {
         // Get all the texts and order them by priority
         $texts = Text::orderBy('priority')->paginate(5);
     
         // Get assigned priorities to avoid duplicates in dropdown
         $assignedPriorities = Text::pluck('priority')->toArray();
         
         // Define a range of priorities (1 to 10)
         $availablePriorities = range(1, 10); // Example range of priorities
         
         // Remove assigned priorities from the available priorities
         $availablePriorities = array_diff($availablePriorities, $assignedPriorities);
     
         // Return the view with texts and available priorities
         return view('admin.text.index', compact('texts', 'availablePriorities'), [
             'title' => 'Manage Text'
         ]);
     }
     
 
     // Show the form to create a new banner
     public function create()
     {
         // Get assigned priorities to avoid duplicates in dropdown
         $assignedPriorities = Text::pluck('priority')->toArray();
         $availablePriorities = range(1, 10); // Example range of priorities
         $availablePriorities = array_diff($availablePriorities, $assignedPriorities);
 
         return view('admin.text.create', compact('availablePriorities'));
     }
 
     // Store a newly created banner in the database
     public function store(Request $request)
     {
         $request->validate([
             'text' => 'required|string|max:255',
             'priority' => 'required|integer|in:' . implode(',', range(1, 10)),
         ]);
 
         Text::create([
             'text' => $request->input('text'),
             'priority' => $request->input('priority'),
         ]);
 
         return redirect()->route('admin.text.index')->with('success', 'Text created successfully.');
     }
 
     // Show the form for editing the specified banner
     public function edit($id)
     {
        $text = Text::findOrFail($id);
         $assignedPriorities = Text::pluck('priority')->toArray();
         $availablePriorities = range(1, 10);
         $availablePriorities = array_diff($availablePriorities, $assignedPriorities);
 
         return view('admin.text.edit', compact('text', 'availablePriorities'));
     }
 
     // Update the specified text in the database
     public function update(Request $request, $id)
     {
        $text = Text::findOrFail($id);
         $request->validate([
             'text' => 'required|string|max:255',
             'priority' => 'required|integer|in:' . implode(',', range(1, 10)),
         ]);
 
         $text->update([
             'text' => $request->input('text'),
             'priority' => $request->input('priority'),
         ]);
 
         return redirect()->route('admin.text.index')->with('success', 'Text updated successfully.');
     }
 
     // Remove the specified text from the database
     public function destroy($id)
     {
        $text = Text::findOrFail($id);
         $text->delete();
         return redirect()->route('admin.text.index')->with('success', 'Text deleted successfully.');
     }
}
