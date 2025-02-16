<?php

namespace Database\Seeders;

use App\Domains\Task\Models\Task;
use App\Domains\Task\Models\TaskList;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        $taskLists = TaskList::all();
        $taskLists->each(function (TaskList $taskList) {
            $taskList->tasks()->createMany(
                Task::factory(50)->make([
                    'project_id'   => $taskList->project_id,
                    'task_list_id' => $taskList->id,
                ])->toArray()
            );
        });
    }
}
