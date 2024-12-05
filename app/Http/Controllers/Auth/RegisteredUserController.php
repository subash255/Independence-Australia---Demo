<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        'last_name' => 'required|string|max:255',
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'address' => 'required|string|max:255',
        'phone_number' => 'required|string|max:20',
        'account_type' => 'required|in:1,2', 

        ]);


        if ($request->account_type == 1) {
            
            $isBusinessAccount = 1;
            $subscribedToNewsletter = 0; 
        } else {
            
            $isBusinessAccount = 0;
            $subscribedToNewsletter = 1; 
        }

        $user = User::create([
           'name' => $request->name,
        'last_name' => $request->last_name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'address' => $request->address,
        'phone_number' => $request->phone_number,
        'is_business_account' => $isBusinessAccount,
        'subscribed_to_newsletter' => $subscribedToNewsletter,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false))->with('status', 'Account created successfully!');
    }
}
