<?php

use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;

public function index()
{
    return TaskResource::collection(Task::all());
}

public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|string',
        'description' => 'nullable|string',
        'due_date' => 'nullable|date',
    ]);

    $task = Task::create($validated);
    return new TaskResource($task);
}

public function show(Task $task)
{
    return new TaskResource($task);
}

public function update(Request $request, Task $task)
{
    $task->update($request->validate([
        'title' => 'sometimes|string',
        'description' => 'nullable|string',
        'due_date' => 'nullable|date',
        'status' => 'sometimes|in:pending,in_progress,completed',
    ]));

    return new TaskResource($task);
}

public function destroy(Task $task)
{
    $task->delete();
    return response()->json(['message' => 'Task deleted successfully']);
}

public function assign(Request $request, Task $task)
{
    $request->validate([
        'user_id' => 'required|exists:users,id',
    ]);

    $task->user_id = $request->user_id;
    $task->save();

    return new TaskResource($task);
}
