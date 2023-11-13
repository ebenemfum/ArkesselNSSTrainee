<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class UserController extends Controller
{
    // Create a new user
    public function createUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        $apiKey = Str::random(32); // Generate a random API key

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'api_key' => $apiKey,
        ]);

        return response()->json(['user' => $user, 'api_key' => $apiKey,'message' => 'User created successfully'], 201);
    }

    // Update an existing user
    public function updateUser(Request $request, $id)
    {
        $request->validate([
            'name' => 'string',
            'email' => 'email|unique:users,email,' . $id,
            'password' => 'string|min:6',
        ]);

        $user = User::findOrFail($id);

        $user->update([
            'name' => $request->input('name', $user->name),
            'email' => $request->input('email', $user->email),
            'password' => $request->has('password') ? Hash::make($request->password) : $user->password,
        ]);

        return response()->json(['user' => $user, 'message' => 'User updated successfully'], 200);
    }

    // Delete a user
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'User deleted successfully'], 200);
    }
    public function showAllUsers()
    {
        $users = User::all();

        return response()->json(['users' => $users], 200);
    }


}
