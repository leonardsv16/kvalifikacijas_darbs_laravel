<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Contracts\Auth\Authenticatable;
use Tests\TestCase;
use App\Models\User;
use App\Models\Task;
class TaskTest extends TestCase
{

    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    // public function test_example(): void
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }

    /** @test */
    public function user_can_create_a_task() {
        /** @var \App\Models\User $user */
        $user = User::factory()->create();

        // Simulē pieslēgšanos
        $this->actingAs($user);

        $response = $this->post(route('tasks.store'), [
            'title' => 'Test Task',
            'description' => 'This is a test task.',
            'status' => 'Not started',
            'start_time' => now(),
            'end_time' => now()->addHours(2),
            'user_id' => $user->id,
            'project_id' => 1,
        ]);

         // Pārbauda, vai uzdevums tika izveidots
         $response->assertStatus(302);
         $this->assertDatabaseHas('tasks', ['title' => 'Test Task']);
    }

    /** @test */
    public function a_user_can_update_a_task()
    {
        /** @var \App\Models\User $user */
        // Izveido lietotāju un uzdevumu
        $user = User::factory()->create();
        $task = Task::factory()->create(['user_id' => $user->id]);

        // Simulē pieslēgšanos
        $this->actingAs($user);

        // Atjaunina uzdevumu
        $response = $this->put(route('tasks.update', $task->id), [
            'title' => 'Updated Task',
            'description' => 'Updated description.',
            'status' => 'Started',
            'start_time' => now(),
            'end_time' => now()->addHours(3),
        ]);

        // Pārbauda, vai uzdevums tika atjaunināts
        $response->assertStatus(302);
        $this->assertDatabaseHas('tasks', ['title' => 'Updated Task']);
    }
    // /** @test */
    // public function a_user_can_delete_a_task()
    // {
    //     /** @var \App\Models\User $user */
    //     // Izveido lietotāju un uzdevumu
    //     $user = User::factory()->create();
    //     $task = Task::factory()->create(['user_id' => $user->id]);

    //     // Simulē pieslēgšanos
    //     $this->actingAs($user);

    //     // Dzēš uzdevumu
    //     $response = $this->delete(route('tasks.destroy', $task->id));

    //     // Pārbauda, vai uzdevums tika dzēsts
    //     $response->assertStatus(302);
    //     $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    // }
}
