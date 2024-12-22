<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    // Show all images (index)
    public function index()
    {
        // Paginate images by 15 entries per page, ordered by priority
        $images = Image::orderBy('priority', 'asc')->paginate(5);
    
        // Pass images and other data to the view
        return view('admin.images.index', compact('images'), [
            'title' => 'Manage Images'
        ]);
    }
    

    // Show form to create a new image
    public function create()
    {
        return view('admin.images.create');
    }

    // Store a new image
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
            'priority' => 'required|integer',
        ]);
    
        // Check if the file is present
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $image = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('banner'), $image);
    
            // Store the image information in the database
            Image::create([
                'priority' => $request->input('priority'),
                'image_url' => $image,
            ]);
    
            return redirect()->route('admin.images.index')->with('success', 'Image created successfully!');
        }
    
        return redirect()->route('admin.images.create')->with('error', 'Image upload failed. Please try again.');
    }
    

    // Show form to edit an image
    public function edit($id)
    {
        $image = Image::findOrFail($id);
        return view('admin.images.edit', compact('image'));
    }

    // Update an image
    public function update(Request $request, $id)
    {
        $request->validate([
            'image_url' => 'required|url',
            'priority' => 'required|integer',
        ]);

        $image = Image::findOrFail($id);
        $image->update($request->all());

        return redirect()->route('admin.images.index')->with('success', 'Image updated successfully!');
    }

    // Delete an image
    public function destroy($id)
    {
        $image = Image::findOrFail($id);
        $image->delete();

        return redirect()->route('admin.images.index')->with('success', 'Image deleted successfully!');
    }
}
