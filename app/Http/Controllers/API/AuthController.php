<?php

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['Invalid credentials.'],
        ]);
    }

    return response()->json([
        'token' => $user->createToken('api-token')->plainTextToken,
        'user' => $user,
    ]);
}

public function logout(Request $request)
{
    $request->user()->tokens()->delete();
    return response()->json(['message' => 'Logged out successfully']);
}
