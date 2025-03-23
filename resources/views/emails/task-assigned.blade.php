@extends('components.layout')

@section('content')
    <div class="container mx-auto mt-6 p-4 bg-white shadow-md rounded-lg">
        <h2 class="text-xl font-bold text-gray-700">Hello {{ $task->user->name }},</h2>
        <p class="mt-2 text-gray-600">You have been assigned a new task:</p>
        
        <div class="mt-4 p-4 border-l-4 border-blue-500 bg-blue-50">
            <p><strong>Title:</strong> {{ $task->title }}</p>
            <p><strong>Description:</strong> {{ $task->description }}</p>
            <p><strong>Due Date:</strong> {{ $task->due_date }}</p>
            <p><strong>Status:</strong> {{ ucfirst($task->status) }}</p>
        </div>

        <p class="mt-4">
            <a href="{{ $taskUrl }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                View Task
            </a>
        </p>
    </div>
@endsection
