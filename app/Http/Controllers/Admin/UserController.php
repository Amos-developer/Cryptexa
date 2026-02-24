<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(20);
        return view('admin.users.index', compact('users'));
    }
    
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }
    
    public function update(Request $request, User $user)
    {
        $request->validate([
            'balance' => 'nullable|numeric|min:0',
            'is_active' => 'nullable|boolean',
        ]);
        
        if ($request->has('balance')) {
            $user->balance = $request->balance;
        }
        
        if ($request->has('is_active')) {
            $user->is_active = $request->is_active;
        }
        
        $user->save();
        
        return redirect()->back()->with('success', 'User updated successfully');
    }
    
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully');
    }
}
