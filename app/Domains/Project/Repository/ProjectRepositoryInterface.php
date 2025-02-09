<?php

namespace App\Domains\Project\Repository;

use App\Domains\Project\Models\Project;
use Illuminate\Pagination\LengthAwarePaginator;

interface ProjectRepositoryInterface
{
    public function paginate(?int $perPage = null): LengthAwarePaginator;

    public function generateProjectKey(string $projectName): string;

    public function create(array $data): Project;

    public function update(Project $project, array $data): Project;
}
