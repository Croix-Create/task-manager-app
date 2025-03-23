<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\VerifyEmail;

class RegisterController extends Controller

{
  public function showRegistrationForm()
  {
      return view('register');
  }

  public function register(Request $request)
  {
      $request->validate([
          'name' => 'required|string',
          'email' => 'required|email|unique:users',
          'password' => 'required|min:8',
      ]);
  
      $verificationToken = Str::random(40); // ✅ Generate token BEFORE saving
  
      $user = User::create([
          'name' => $request->name,
          'email' => $request->email,
          'password' => Hash::make($request->password),
          'verification_token' => $verificationToken, // ✅ Assign token here
      ]);
  
      \Log::info('Generated verification token: ' . $verificationToken); // Debugging
  
      if (!$user->verification_token) {
          \Log::error('Verification token is missing for user ID: ' . $user->id);
          return back()->withErrors('Verification token missing.');
      }
  
      Mail::to($user->email)->send(new VerifyEmail($user));
  
      return response()->json(['message' => 'Verification email sent.'], 200);
  }
  

  public function verify($token)
  {
    \Log::info('Verify sstart');
      $user = User::where('verification_token', $token)->first();

      if (!$user) {
          return response()->json(['message' => 'Invalid or expired verification token.'], 400);
      }

      // Mark the user as verified
      $user->email_verified_at = now();
      //$user->verification_token = null; // Clear the token after verification
      $user->save();

      return response()->json(['message' => 'Email successfully verified.'], 200);

      \Log::info('Verify sent');
  }


  public function resendVerification(Request $request)
  {
    $request->validate([
      'email' => 'required|email'
    ]);

    $user = User::where('email', $request->email)->first();

    if(!$user){
      return response()->json(['message' => 'User not found'], 404);
    }

    if($user->email_verified_at){
      return response()->json(['message' => 'Email already verified'], 400);
    }

    $user->verification_token = Str::random(40);
    $user->save();

    Mail::to($user->email)->send(new VerifyEmail($user));

    return response()->json(['message' => 'Verification email resent.'], 200);
  }
}
