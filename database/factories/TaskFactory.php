<?php

namespace Database\Factories;

use App\Domains\Project\Models\Project;
use App\Domains\Task\Enums\Priority;
use App\Domains\Task\Enums\TaskStatus;
use App\Domains\Task\Models\Task;
use App\Utils\EntityKeyUtil;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition(): array
    {
        $name = $this->faker->name();

        $status = $this->faker->randomElement([
            TaskStatus::Open,
            TaskStatus::InProgress,
            TaskStatus::ReadyToTest,
            TaskStatus::Closed,
        ]);

        $priority = $this->faker->randomElement([
            Priority::Low,
            Priority::Medium,
            Priority::High,
        ]);

        $projectId = Project::query()->select('id')->inRandomOrder()->first()->id;

        return [
            'project_id'   => $projectId,
            'task_list_id' => null,
            'name'         => $name,
            'key'          => EntityKeyUtil::generateEntityUniqKey($name, new Task),
            'description'  => $this->faker->text(),
            'status'       => $status,
            'priority'     => $priority,
            'due_date'     => $this->faker->dateTimeBetween('now', '+1 year'),
        ];
    }
}
