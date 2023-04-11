<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('users.home', compact('users'));
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }
    
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }
    
    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'required|string|max:11',
            'password' => 'required',
        ]);
    
        $user->update($validatedData);
    
        return redirect('/users/' . $user->id);
    }
    
    public function destroy(User $user)
    {
        $user->delete();
    
        return redirect('/users');
    }   
}

