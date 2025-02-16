<?php

namespace App\Domains\Task\Repository;

use Illuminate\Pagination\LengthAwarePaginator;

interface TaskRepositoryInterface
{
    public function paginate(?int $perPage = null): LengthAwarePaginator;
}
