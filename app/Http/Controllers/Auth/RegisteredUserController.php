<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Text;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $sliderTexts = Text::orderBy('priority')->get();
        $categories=Category::with('subcategories')->get();
        return view('auth.register',compact('categories','sliderTexts'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'nullable|string', // Single role is now acceptable
            'address' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
        ]);
    
        // Create a new user
        $user = new User();
        $user->name = $validated['name'];
        $user->last_name = $validated['last_name'];
        $user->email = $validated['email'];
        $user->password = Hash::make($validated['password']);
        
        // If the checkbox is checked, save the 'store' role, otherwise, default to 'user'
        if ($request->has('role')) {
            $user->role = 'vendor';  // Here you can modify based on your requirements
        } else {
            $user->role = 'user';  // Default role if checkbox isn't checked
        }
    
        $user->address = $validated['address'];
        $user->phone_number = $validated['phone_number'];
        $user->save();  // Save the user to the database
    
        return redirect()->route('login')->with('success', 'Account created successfully!');
    } 
    
           


}
