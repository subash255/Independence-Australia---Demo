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
        $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'role' => 'nullable|string|in:user,vendor',// Ensure role is either user or vendor
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'address' => 'required|string',
            'phone_number' => 'required|string',
        ]);
    
        // Create the user based on the selected role
        $user = User::create([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role?: 'user',  // Ensure the role is passed here
            'address' => $request->address,
            'phone_number' => $request->phone_number,
        ]);
    
        // Redirect or perform further actions
        return redirect()->route('login')->with('success', 'Account created successfully!');
    }    


}
