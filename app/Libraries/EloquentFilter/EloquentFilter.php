<?php

namespace App\Libraries\EloquentFilter;

use Illuminate\Database\Eloquent\Builder;

abstract class EloquentFilter
{
    protected ParameterBag $parameterBag;

    abstract public function apply(Builder $query): Builder;

    public function setParameterBag(array|ParameterBag $parameterBag): void
    {
        if (is_array($parameterBag)) {
            $parameterBag = new ParameterBag($parameterBag);
        }

        $this->parameterBag = $parameterBag;
    }

    protected function getListSeparator(): string
    {
        return '|';
    }
}
