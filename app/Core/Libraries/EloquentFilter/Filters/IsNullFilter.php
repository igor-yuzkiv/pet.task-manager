<?php

namespace App\Core\Libraries\EloquentFilter\Filters;

use App\Core\Libraries\EloquentFilter\EloquentFilter;
use Illuminate\Database\Eloquent\Builder;

class IsNullFilter extends EloquentFilter
{
    public function apply(Builder $query): Builder
    {
        $fieldName = $this->parameterBag->get(['name', 0]);
        if (! $fieldName) {
            return $query;
        }

        return $query->whereNull($fieldName);
    }
}
