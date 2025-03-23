<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        return view('dashboard', compact('tasks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date'    => 'nullable|date',
            'status'      => 'required|in:pending,in progress,completed',
        ]);

        Task::create($request->all());

        return redirect()->route('dashboard')->with('success', 'Task added successfully!');
    }


    public function edit(Task $task)
    {
        return view('auth.edit-task', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date'    => 'nullable|date',
            'status'      => 'required|in:pending,in progress,completed',
        ]);

        $task->update($request->all());

        return redirect()->route('dashboard')->with('success', 'Task updated successfully!');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('dashboard')->with('success', 'Task deleted successfully!');
    }
}

