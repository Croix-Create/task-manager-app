<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        if (!auth()->user()->is_admin) {
            abort(403, 'Unauthorized action.');
        }

        $activities = TaskActivity::with(['task', 'user'])->latest()->paginate(10);

        return view('admin.dashboard', compact('activities'));
    }
}
