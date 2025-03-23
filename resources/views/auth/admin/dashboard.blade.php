@extends('layouts.app')

@section('content')
<div class="flex justify-center items-center min-h-screen">
    <div class="bg-white shadow-lg rounded-lg p-6 w-full max-w-3xl text-center">
        <h2 class="text-3xl font-bold text-gray-700">Admin Dashboard</h2>
        <p class="text-gray-600 mt-2">Welcome, {{ Auth::user()->name }}</p>
        <a href="{{ route('logout') }}" 
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
           class="inline-block bg-red-600 text-white px-4 py-2 mt-4 rounded hover:bg-red-700">
            Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
            @csrf
        </form>
    </div>
</div>
@endsection