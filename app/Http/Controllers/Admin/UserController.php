<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::withCount('referrals')->latest()->paginate(20);
        return view('admin.users.index', compact('users'));
    }
    
    public function create()
    {
        return view('admin.users.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
        
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'account_id' => 'USR' . strtoupper(substr(md5(uniqid()), 0, 8)),
        ]);
        
        return redirect()->route('admin.users.index')->with('success', 'User created successfully');
    }
    
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }
    
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }
    
    public function update(Request $request, User $user)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'password' => 'nullable|min:6|confirmed',
            'role' => 'required|in:user,admin',
            'balance' => 'nullable|numeric|min:0',
        ]);
        
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->role = $request->role;
        
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }
        
        if ($request->has('balance')) {
            $user->balance = $request->balance;
        }
        
        $user->save();
        
        return redirect()->route('admin.users.index')->with('success', 'User updated successfully');
    }
    
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully');
    }
}
