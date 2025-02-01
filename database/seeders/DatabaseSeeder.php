<?php

namespace Database\Seeders;

use App\Domains\Project\Models\Project;
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
        User::factory(5)->create();

        Project::factory(10)->create();

        $users = User::all();
        Project::all()->each(function (Project $project) use ($users) {
            $project->owners()->sync(
                $users->random(rand(1, 3))->pluck('id')->toArray()
            );
        });
    }
}
