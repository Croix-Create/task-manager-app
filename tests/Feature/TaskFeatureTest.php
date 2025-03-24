<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Task;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

class TaskFeatureTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_task_can_be_created()
    {
        $task = Task::factory()->create([
            'title' => 'Test Task',
            'description' => 'This is a test task.',
        ]);

        $this->assertInstanceOf(Task::class, $task);
        $this->assertEquals('Test Task', $task->title);
        $this->assertEquals('This is a test task.', $task->description);
    }

    /** @test */
    public function an_authenticated_user_can_create_a_task()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user); // Authenticate user

        $response = $this->postJson('/api/tasks', [
            'title' => 'New Task',
            'description' => 'Task description',
            'due_date' => now()->addDays(3),
            'status' => 'pending',
        ]);

        $response->assertStatus(201)
            ->assertJson(['message' => 'Task created successfully']);
    }

    /** @test */
    public function a_user_can_view_their_tasks()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        Task::factory()->count(3)->create(['user_id' => $user->id]);

        $response = $this->getJson('/api/tasks');

        $response->assertStatus(200)
            ->assertJsonCount(3, 'tasks');
    }

    /** @test */
    public function a_task_can_be_assigned_to_another_user()
    {
        $user = User::factory()->create();
        $assignee = User::factory()->create();
        Sanctum::actingAs($user);

        $task = Task::factory()->create(['user_id' => $user->id]);

        $response = $this->postJson("/api/tasks/{$task->id}/assign", [
            'assignee_id' => $assignee->id,
        ]);

        $response->assertStatus(200)
            ->assertJson(['message' => 'Task assigned successfully']);
    }

    public function test_the_application_returns_a_successful_response(): void
    {
        $user = \App\Models\User::factory()->create(); // Create a user
        $response = $this->actingAs($user)->get('/'); // Authenticate the request

        $response->assertStatus(200);
    }

}

