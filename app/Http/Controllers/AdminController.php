<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index()
    {
        // Paginate admins, excluding supedr_admins
        $admins = User::where('role', 'admin')->paginate(10);

        return view('admin.admin.index', compact('admins'), [
            'title' => 'Manage Admin'
        ]);
    }

    // Show create form
    public function create()
    {
        return view('admin.admin.create', [
            'title' => 'Create Admin'
        ]);
    }

    // Store new admin
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'admin', // Set role to 'admin'
        ]);

        return redirect()->route('admin.admin.index')->with('success', 'Admin created successfully');
    }

    // Show edit form
    public function edit(User $user)
    {
        return view('admin.admin.edit', compact('user'), [
            'title' => 'Edit Admin'
        ]);
    }

    // Update admin details
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        if ($request->has('password') && $validated['password']) {
            $user->password = Hash::make($validated['password']);
        }
        $user->save();

        return redirect()->route('admin.admin.index')->with('success', 'Admin updated successfully');
    }

    // Delete an admin
    public function destroy(User $user)
    {
        if ($user->role === 'super_admin') {
            return redirect()->route('admin.admin.index')->with('error', 'Cannot delete a super admin');
        }

        $user->delete();
        return redirect()->route('admin.admin.index')->with('success', 'Admin deleted successfully');
    }
}
