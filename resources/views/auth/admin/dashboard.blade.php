@extends('components.layout')

@section('content')
    <div class="container mx-auto flex flex-col items-center justify-center min-h-screen">
        <h1 class="text-3xl font-bold mb-6">Admin Dashboard</h1>

        <div class="grid grid-cols-2 gap-6 w-full max-w-4xl">
            <!-- Left Column: Task List -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-4">Tasks</h2>
                <ul>
                    @foreach ($tasks as $task)
                        <li class="mb-2">
                            <a href="{{ route('tasks.activity-log', ['task' => $task->id]) }}" 
                               class="block bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition">
                                {{ $task->title }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Right Column: Activity Logs -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-4">Activity Logs</h2>
                <ul>
                    @foreach ($activities as $activity)
                        <li class="mb-2 bg-gray-100 p-2 rounded-md">
                            <span class="text-gray-700 text-sm">
                                Task #{{ $activity->task_id }} - {{ $activity->action }} by {{ $activity->user->name }}
                            </span>
                            <br>
                            <span class="text-gray-500 text-xs">
                                {{ $activity->created_at->diffForHumans() }}
                            </span>
                        </li>
                    @endforeach
                </ul>

            </div>
        </div>
    </div>
@endsection
