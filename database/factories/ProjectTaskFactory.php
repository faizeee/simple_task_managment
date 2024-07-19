<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\ProjectTask;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProjectTask>
 */
class ProjectTaskFactory extends Factory
{
    protected $model = ProjectTask::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return  [
            'project_id' => Project::factory(),
            'title' => $this->faker->sentence(6),
            'priority' => $this->faker->numberBetween(1, 10),
        ];
    }
}
