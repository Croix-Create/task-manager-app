<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{

    
    public function index(Request $request)
    {
        // Ensure user is authenticated
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to view tasks.');
        }

        $user = auth()->user();
        $query = Task::query();

        // Show all tasks if admin, otherwise only the user's tasks
        if (!$user->is_admin) {
            $query->where('user_id', $user->id);
        }

        // Apply search filters if search button is used
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Filter by due date
        if ($request->filled('due_date')) {
            $query->whereDate('due_date', $request->input('due_date'));
        }

        $tasks = $query->get();

        return view('dashboard', compact('tasks'));
    }

    use App\Models\TaskActivity;

    private function logActivity($task, $action, $changes = null)
    {
        TaskActivity::create([
            'task_id' => $task->id,
            'user_id' => auth()->id(),
            'action' => $action,
            'changes' => $changes ? json_encode($changes) : null,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'status' => 'required|in:pending,in progress,completed',
        ]);

        $task = Task::create(array_merge($validated, ['user_id' => auth()->id()]));
        
        $this->logActivity($task, 'created');

        return redirect()->route('dashboard')->with('success', 'Task created successfully!');
    }

    public function update(Request $request, Task $task)
    {
        $oldData = $task->only(['title', 'description', 'due_date', 'status']);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'status' => 'required|in:pending,in progress,completed',
        ]);

        $task->update($validated);

        $this->logActivity($task, 'updated', array_diff_assoc($validated, $oldData));

        return redirect()->route('dashboard')->with('success', 'Task updated successfully!');
    }

    public function destroy(Task $task)
    {
        if (auth()->id() !== $task->user_id && !auth()->user()->is_admin) {
            abort(403, 'Unauthorized action.');
        }

        $task->delete();

        $this->logActivity($task, 'deleted');

        return redirect()->route('dashboard')->with('success', 'Task deleted successfully!');
    }


}


