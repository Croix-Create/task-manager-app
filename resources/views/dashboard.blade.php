@extends('components.layout')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Dashboard</h1>

        {{-- Add Task Form --}}
        <form action="{{ route('tasks.store') }}" method="POST" class="mb-4">
            @csrf
            <input type="text" name="title" placeholder="Enter task title" class="border p-2 w-full mb-2" required>
            <textarea name="description" placeholder="Enter task description" class="border p-2 w-full mb-2"></textarea>
            <input type="date" name="due_date" class="border p-2 w-full mb-2">
            <select name="status" class="border p-2 w-full mb-2">
                @foreach (App\Models\Task::statuses() as $status)
                    <option value="{{ $status }}">{{ ucfirst($status) }}</option>
                @endforeach
            </select>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2">Add Task</button>
        </form>

        {{-- Task List --}}
        <ul>
            @foreach ($tasks as $task)
                <li class="flex justify-between border p-2 mb-2">
                    <div>
                        <strong>{{ $task->title }}</strong> - {{ $task->description }} <br>
                        Due: {{ $task->due_date ?? 'No due date' }} | Status: <span class="font-bold">{{ ucfirst($task->status) }}</span>
                    </div>
                    <div>
                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500">Delete</button>
                        </form>
                        <a href="{{ route('tasks.edit', $task) }}" class="text-blue-500 ml-2">Edit</a>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
@endsection