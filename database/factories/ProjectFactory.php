<?php

namespace Database\Factories;

use App\Domains\Project\Enums\ProjectStatus;
use App\Domains\Project\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ProjectFactory extends Factory
{
    protected $model = Project::class;

    public function definition(): array
    {
        return [
            'name'        => $this->faker->name(),
            'description' => $this->faker->text(),
            'status'      => ProjectStatus::Active,
            'deleted_at'  => null,
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now(),
        ];
    }
}
