@extends('components.layout')

@section('content')
<div class="flex justify-center items-center min-h-screen">
    <div class="w-full max-w-md bg-white shadow-lg rounded-lg p-6">
        <h2 class="text-2xl font-bold text-center text-gray-700">Login</h2>
        <form method="POST" action="{{ route('login') }}" class="mt-4">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-gray-600">Email</label>
                <input type="email" name="email" class="w-full p-2 border border-gray-300 rounded mt-1" required autofocus>
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-600">Password</label>
                <input type="password" name="password" class="w-full p-2 border border-gray-300 rounded mt-1" required>
            </div>
            <div class="flex items-center justify-between mb-4">
                <div>
                    <input type="checkbox" id="remember" name="remember" class="mr-1">
                    <label for="remember" class="text-sm text-gray-600">Remember Me</label>
                </div>
                <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:underline">Forgot Password?</a>
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white p-2 rounded hover:bg-blue-700">
                Login
            </button>
        </form>
    </div>
</div>
@endsection
