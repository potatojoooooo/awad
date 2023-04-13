<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function createUser(Request $request)
    {
        // Check if the user is authorized to create a user
        if (Gate::denies('create', User::class)) {
            abort(403);
        }

        // Your code to create a new user
    }

    public function displayUser($id)
    {
        // Find the user by ID
        $user = User::findOrFail($id);

        // Check if the user is authorized to view the user
        if (Gate::denies('view', $user)) {
            abort(403);
        }

        // Your code to display the user
    }

    public function updateUser(Request $request, $id)
    {
        // Find the user by ID
        $user = User::findOrFail($id);

        // Check if the user is authorized to update the user
        if (Gate::denies('update', $user)) {
            abort(403);
        }

        // Your code to update the user
    }
}

