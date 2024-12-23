<?php

namespace App\Http\Controllers;

use App\Models\Text;
use Illuminate\Http\Request;

class TextController extends Controller
{
     // Display a listing of the banners
     public function index()
     {
         $texts = Text::orderBy('priority')->paginate(5);  // Correct method for pagination
         return view('admin.text.index', compact('texts'));
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
     public function edit(Text $banner)
     {
         $assignedPriorities = Text::pluck('priority')->toArray();
         $availablePriorities = range(1, 10);
         $availablePriorities = array_diff($availablePriorities, $assignedPriorities);
 
         return view('admin.text.edit', compact('banner', 'availablePriorities'));
     }
 
     // Update the specified banner in the database
     public function update(Request $request, Text $banner)
     {
         $request->validate([
             'text' => 'required|string|max:255',
             'priority' => 'required|integer|in:' . implode(',', range(1, 10)),
         ]);
 
         $banner->update([
             'text' => $request->input('text'),
             'priority' => $request->input('priority'),
         ]);
 
         return redirect()->route('admin.text.index')->with('success', 'Text updated successfully.');
     }
 
     // Remove the specified banner from the database
     public function destroy(Text $banner)
     {
         $banner->delete();
         return redirect()->route('admin.text.index')->with('success', 'Text deleted successfully.');
     }
}
