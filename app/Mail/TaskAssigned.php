<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Task;

class TaskAssigned extends Mailable
{
    use Queueable, SerializesModels;

    public $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    public function build()
    {
        return $this->subject('You Have Been Assigned a New Task')
                    ->view('emails.task-assigned')
                    ->with([
                        'task' => $this->task,
                        'taskUrl' => url('/tasks/' . $this->task->id),
                    ]);
    }
}
