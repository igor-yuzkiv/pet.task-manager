<?php

namespace App\Core\Http\Controllers;

abstract class ResourceController
{
    abstract public function getModelClass(): string;

    protected function getPerPage(): int
    {
        return request()->input('per_page', 10);
    }

    protected function getFilters(): array
    {
        return request()->input('filters', []);
    }
}
