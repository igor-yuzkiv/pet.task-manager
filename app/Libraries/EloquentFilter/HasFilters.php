<?php

namespace App\Libraries\EloquentFilter;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

trait HasFilters
{
    public function scopeFilter(Builder $query, array|EloquentFilter $filters): Builder
    {
        if ($filters instanceof EloquentFilter) {
            return $filters->apply($query);
        }

        $resolver = app(EloquentFiltersResolver::class);
        $modelFilters = $this->getModelFilters();

        foreach ($filters as $item) {
            if (is_string($item)) {
                $item = Str::endsWith($item, '::class')
                    ? new $item
                    : $resolver->resolveModelFiltersFromSchema($item, $modelFilters);
            }

            if ($item instanceof EloquentFilter) {
                $query = $item->apply($query);
            } else {
                throw new \InvalidArgumentException('Invalid filter');
            }
        }

        return $query;
    }

    public function getModelFilters(): array
    {
        $reflection = new \ReflectionClass($this);
        $arguments = $reflection->getAttributes(FiltersAttribute::class);
        if (empty($arguments)) {
            return [];
        }

        return $arguments[0]->getArguments()[0];
    }
}
