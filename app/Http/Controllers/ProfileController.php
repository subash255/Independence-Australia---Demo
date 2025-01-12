<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    
    public function edit(User $user)
    {
        return view('user.edit', compact('user'));
    }

    // Handle the user update form submission
    public function update(ProfileUpdateRequest $request, User $user): RedirectResponse
    {
        // Fill the user model with validated data
        $user->fill($request->validated());

        // Check if the email has changed, if so set email_verified_at to null
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // If the password is provided, hash and update it
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Save the updated user data
        $user->save();

        // Redirect back to the profile edit page with a success status
        return Redirect::route('user.welcome', $user->id)->with('success', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function authorize()
    {
        // Check if the user is authorized to make this request
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . request()->route('user'), // Avoid conflict with current email
            'password' => 'nullable|confirmed|min:8', // password confirmation and min length
        ];
    }
}
