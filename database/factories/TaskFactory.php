<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'name'           => fake()->unique()->name,
            'description'    => fake()->text,
            'status_id'      => TaskStatus::factory(),
            'created_by_id'  => User::factory(),
            'assigned_to_id' => User::factory(),
        ];
    }
}
