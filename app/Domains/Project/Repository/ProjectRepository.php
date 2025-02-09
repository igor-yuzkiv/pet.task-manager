<?php

namespace App\Domains\Project\Repository;

use App\Domains\Project\Enums\ProjectStatus;
use App\Domains\Project\Models\Project;
use App\Domains\Project\Services\GenerateProjectKey;
use Illuminate\Pagination\LengthAwarePaginator;

class ProjectRepository implements ProjectRepositoryInterface
{
    public function paginate(?int $perPage = null): LengthAwarePaginator
    {
        return Project::query()
            ->orderBy('updated_at', 'desc')
            ->paginate(perPage: $perPage ?? 10);
    }

    public function generateProjectKey(string $projectName): string
    {
        return app(GenerateProjectKey::class)->handle($projectName);
    }

    public function create(array $data): Project
    {
        $project = new Project($data);
        $project->key = $this->generateProjectKey($project->name);
        $project->status = ProjectStatus::Open;
        $project->save();

        return $project;
    }

    public function update(Project $project, array $data): Project
    {
        $project->fill($data);
        $project->save();

        return $project;
    }
}
