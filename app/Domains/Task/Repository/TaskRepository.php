<?php

namespace App\Domains\Task\Repository;

use App\Domains\Task\Models\Task;
use Illuminate\Pagination\LengthAwarePaginator;

class TaskRepository implements TaskRepositoryInterface
{
    public function paginate(?int $perPage = null, array $filters = []): LengthAwarePaginator
    {
        return Task::query()
            ->filter($filters)
            ->orderBy('updated_at', 'desc')
            ->paginate(perPage: $perPage ?? 10);
    }
}
