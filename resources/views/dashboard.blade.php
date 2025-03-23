@extends('components.layout')

@section('content')

        <div class="flex justify-center my-6">
            <form method="GET" action="{{ route('dashboard') }}" class="flex items-center space-x-2 bg-white p-4 rounded-lg shadow-md">
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}" 
                    placeholder="Search tasks..." 
                    class="border border-gray-300 rounded-lg p-2 w-72 focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-600 transition">
                    Search
                </button>
            </form>
        </div>

        {{-- Add Task Form --}}
        <form action="{{ route('tasks.store') }}" method="POST" class="mb-4">
            @csrf
            <input type="text" name="title" placeholder="Enter task title" class="border p-2 w-full mb-2" required>
            <textarea name="description" placeholder="Enter task description" class="border p-2 w-full mb-2"></textarea>
            <input type="date" name="due_date" class="border p-2 w-full mb-2">

            {{-- Status Selection --}}
            <select name="status" class="border p-2 w-full mb-2">
                @foreach (App\Models\Task::statuses() as $status)
                    <option value="{{ $status }}">{{ ucfirst($status) }}</option>
                @endforeach
            </select>

            {{-- Assign User (Optional) --}}
            <select name="user_id" class="border p-2 w-full mb-2">
                <option value="">Assign to (Optional)</option>
                @foreach (App\Models\User::all() as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2">Add Task</button>
        </form>

        {{-- Task List --}}
        <ul>
        @foreach ($tasks as $task)
    <div class="p-4 border rounded-lg shadow-md mb-4">
        <h3 class="text-lg font-semibold">{{ $task->title }}</h3>
        <p class="text-gray-600">{{ $task->description }}</p>
        <p class="text-sm text-gray-500">Due Date: {{ $task->due_date }}</p>
        <p class="text-sm text-gray-500">Status: {{ ucfirst($task->status) }}</p>
        <p class="text-sm text-gray-500">Assigned to: {{ $task->user ? $task->user->name : 'Unassigned' }}</p>

        
        @if(auth()->user()->id === $task->user_id || auth()->user()->is_admin)
            <div class="mt-2 flex gap-2">
                <a href="{{ route('tasks.edit', $task->id) }}" 
                   class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                    Edit
                </a>

                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" 
                      onsubmit="return confirm('Are you sure you want to delete this task?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                        Delete
                    </button>
                </form>
            </div>
        @endif
    </div>
@endforeach

        </ul>
    </div>
@endsection
