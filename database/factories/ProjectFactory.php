<?php

namespace Database\Factories;

use App\Domains\Project\Enums\ProjectStatus;
use App\Domains\Project\Models\Project;
use App\Utils\EntityKeyUtil;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ProjectFactory extends Factory
{
    protected $model = Project::class;

    public function definition(): array
    {
        $name = $this->faker->name();
        $key = EntityKeyUtil::generateEntityUniqKey($name, new Project);

        $status = $this->faker->randomElement([
            ProjectStatus::Open,
            ProjectStatus::Active,
            ProjectStatus::InProgress,
            ProjectStatus::Closed,
        ]);

        return [
            'name'        => $name,
            'key'         => $key,
            'description' => $this->faker->text(),
            'status'      => $status,
            'deleted_at'  => null,
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now(),
        ];
    }
}
