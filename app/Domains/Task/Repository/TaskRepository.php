<?php

namespace App\Domains\Task\Repository;

use App\Domains\Task\Models\Task;
use Illuminate\Pagination\LengthAwarePaginator;

class TaskRepository implements TaskRepositoryInterface
{
    public function paginate(?int $perPage = null): LengthAwarePaginator
    {
        return Task::query()
            ->orderBy('updated_at', 'desc')
            ->paginate(perPage: $perPage ?? 10);
    }
}
