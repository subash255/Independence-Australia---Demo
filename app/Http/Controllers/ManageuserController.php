<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ManageuserController extends Controller
{
public function index()
{
    // Check if the currently authenticated user is a vendor and pagination
    $authenticatedUser = Auth::user();

    // Check if the authenticated user is a vendor
    if ($authenticatedUser->role !== 'vendor') {
        return response()->json(['error' => 'Only vendors can view users'], 403);
    }

    // Get users based on the vendor_id of the authenticated user
    $users = User::where('role', 'user')
    ->where('vendor_id', $authenticatedUser->id)
    ->paginate(5);
    //route for user index
    return view('user.manageuser.index', compact('users'));

}
public function create()
{
    return view('user.manageuser.create');

}
    public function store(Request $request)
{
    // Check if the currently authenticated user is a vendor
    $authenticatedUser = Auth::user(); // assuming you're using Laravel's built-in auth

    if ($authenticatedUser->role !== 'vendor') {
        return response()->json(['error' => 'Only vendors can create users'], 403);
    }

    // Validation for the new user data
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|string|min:8',
        'address' => 'required|string',
        'phone_number' => 'required|string',
    ]);

    // Create the new user
    $user = User::create([
        'name' => $validatedData['name'],
        'last_name' => $request->last_name,
        'email' => $validatedData['email'],
        'password' => bcrypt($validatedData['password']),
        'role' => $request->input('role', 'user'), // Default to 'user' if no role is specified
        'vendor_id' => $authenticatedUser->role === 'vendor' ? $authenticatedUser->id : null, // Set vendor_id if the creator is a vendor
        'address' => $request->address,
            'phone_number' => $request->phone_number,
    ]);

    return response()->json(['message' => 'User created successfully', 'user' => $user]);
}
}
