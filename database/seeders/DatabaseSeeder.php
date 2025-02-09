<?php

namespace Database\Seeders;

use App\Domains\Project\Models\Project;
use App\Domains\Task\Models\Task;
use App\Domains\Task\Models\TaskList;
use App\Domains\User\Models\User;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(5)->create();

        Project::factory(10)->create();

        TaskList::factory(10)
            ->create()
            ->each(function (TaskList $taskList) {
                Task::factory(5)->create([
                    'project_id'   => $taskList->project_id,
                    'task_list_id' => $taskList->id,
                ]);
            });

        $users = User::all();

        Project::all()->each(function (Project $project) use ($users) {
            $project->owners()->sync(
                $users->random(rand(1, 3))->pluck('id')->toArray()
            );
        });

        Task::all()->each(function (Task $task) use ($users) {
            $task->owners()->sync(
                $users->random(rand(1, 3))->pluck('id')->toArray()
            );
        });
    }
}
