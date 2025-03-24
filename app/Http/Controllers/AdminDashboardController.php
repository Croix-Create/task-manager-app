<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\TaskActivity;


class AdminDashboardController extends Controller
{
    public function index()
    {
        // Ensure only admins can access
        if (!auth()->user()->is_admin) {
            abort(403, 'Unauthorized action.');
        }

        // Retrieve all tasks and activities
        $tasks = Task::latest()->paginate(10);
        $activities = TaskActivity::latest()->paginate(10);

        return view('auth.admin.dashboard', compact('tasks', 'activities'));
    }
}
