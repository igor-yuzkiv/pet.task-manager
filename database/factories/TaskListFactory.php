<?php

namespace Database\Factories;

use App\Domains\Project\Models\Project;
use App\Domains\Task\Models\TaskList;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskListFactory extends Factory
{
    protected $model = TaskList::class;

    public function definition(): array
    {
        $projectId = Project::query()->select('id')->inRandomOrder()->first()->id;

        return [
            'project_id' => $projectId,
            'name'       => $this->faker->name(),
        ];
    }
}
