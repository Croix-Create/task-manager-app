<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskActivity extends Model
{
    use HasFactory;

    protected $fillable = ['task_id', 'user_id', 'action', 'changes'];

    protected $casts = [
        'changes' => 'array', // Automatically converts JSON to an array
    ];

    // Relationship: Each activity belongs to a task
    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    // Relationship: Each activity is performed by a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
