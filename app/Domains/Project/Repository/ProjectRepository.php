<?php

namespace App\Domains\Project\Repository;

use App\Domains\Project\Enums\ProjectStatus;
use App\Domains\Project\Models\Project;
use App\Utils\EntityKeyUtil;
use Illuminate\Pagination\LengthAwarePaginator;

class ProjectRepository implements ProjectRepositoryInterface
{
    public function paginate(?int $perPage = null, array $filters = []): LengthAwarePaginator
    {
        return Project::query()
            ->filter($filters)
            ->orderBy('updated_at', 'desc')
            ->paginate(perPage: $perPage ?? 10);
    }

    public function generateProjectKey(string $projectName): string
    {
        return EntityKeyUtil::generateEntityUniqKey($projectName, new Project);
    }

    public function create(array $data): Project
    {
        $project = new Project($data);

        if (empty($project->key)) {
            $project->key = $this->generateProjectKey($project->name);
        }

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
