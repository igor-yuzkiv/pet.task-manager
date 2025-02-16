<?php

namespace App\Libraries\EloquentFilter\Filters;

use App\Libraries\EloquentFilter\EloquentFilter;
use Illuminate\Database\Eloquent\Builder;

class IsNotNullFilter extends EloquentFilter
{
    public function apply(Builder $query): Builder
    {
        $fieldName = $this->parameterBag->get(['name', 0]);
        if (! $fieldName) {
            return $query;
        }

        return $query->whereNotNull($fieldName);
    }
}
