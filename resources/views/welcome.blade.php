@extends('components.layout')

@section('content')
<div class="flex items-center justify-center min-h-screen">
    <div class="text-center">
        <h1 class="text-4xl font-bold text-gray-700">Welcome to Task Manager</h1>
        <p class="text-gray-600 mt-2">A simple way to manage your tasks efficiently.</p>
        <div class="mt-6 flex justify-center space-x-4">
            <a href="{{ route('register') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg shadow-md hover:bg-blue-700">
                Get Started
            </a>
            <a href="{{ route('login') }}" class="bg-gray-600 text-white px-6 py-3 rounded-lg shadow-md hover:bg-gray-700">
                Login
            </a>
        </div>
    </div>
</div>
@endsection
