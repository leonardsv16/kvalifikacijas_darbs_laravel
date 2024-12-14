<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Project;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'description' => 'random desc',
            'status' => $this->faker->randomElement(['Not started', 'Started', 'Finished','Checked']),

            'user_id' => User::factory(),
            'project_id' => Project::factory(),
        ];
    }
}
