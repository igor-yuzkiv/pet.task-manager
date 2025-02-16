<?php

namespace App\Core\Libraries\EloquentFilter\Filters;

use App\Core\Libraries\EloquentFilter\EloquentFilter;
use App\Core\Libraries\EloquentFilter\MatchMode;
use Illuminate\Database\Eloquent\Builder;

class IntegerFilter extends EloquentFilter
{
    public function apply(Builder $query): Builder
    {
        $fieldName = $this->parameterBag->get('name');
        $value = $this->getValue();
        $matchMode = $this->parameterBag->matchMode(MatchMode::EQUALS);

        if (! $fieldName || ! $value || ! $this->isSupportedMatchMode($matchMode)) {
            return $query;
        }

        return match ($matchMode) {
            MatchMode::EQUALS                   => $query->where($fieldName, $value),
            MatchMode::NOT_EQUALS               => $query->whereNot($fieldName, $value),
            MatchMode::GREATER_THAN             => $query->where($fieldName, '>', $value),
            MatchMode::GREATER_THAN_OR_EQUAL_TO => $query->where($fieldName, '>=', $value),
            MatchMode::IN                       => $query->whereIn($fieldName, $value),
            MatchMode::NOT_IN                   => $query->whereNotIn($fieldName, $value),
            default                             => $query,
        };
    }

    private function getValue(): null|int|array
    {
        $value = $this->parameterBag->get(['value']);
        if (! $value) {
            return null;
        }

        $value = trim($value);
        $mathMode = $this->parameterBag->matchMode();

        if ($mathMode === MatchMode::IN || $mathMode === MatchMode::NOT_IN) {
            $value = explode($this->getListSeparator(), $value);

            return array_map('intval', $value);
        }

        return intval($value);
    }

    public function isSupportedMatchMode(MatchMode $mode): bool
    {
        $supportedModes = [
            MatchMode::EQUALS,
            MatchMode::NOT_EQUALS,
            MatchMode::GREATER_THAN,
            MatchMode::GREATER_THAN_OR_EQUAL_TO,
            MatchMode::IN,
            MatchMode::NOT_IN,
        ];

        return in_array($mode, $supportedModes);
    }
}
