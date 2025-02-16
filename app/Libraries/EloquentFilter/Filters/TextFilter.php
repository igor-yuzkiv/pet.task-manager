<?php

namespace App\Libraries\EloquentFilter\Filters;

use App\Libraries\EloquentFilter\EloquentFilter;
use App\Libraries\EloquentFilter\MatchMode;
use Illuminate\Database\Eloquent\Builder;

class TextFilter extends EloquentFilter
{
    public function apply(Builder $query): Builder
    {
        $fieldName = $this->parameterBag->get(['name']);
        $value = $this->getValue();
        $matchMode = $this->parameterBag->matchMode(MatchMode::EQUALS);

        if (! $fieldName || ! $value || ! $this->isSupportedMatchMode($matchMode)) {
            return $query;
        }

        return match ($matchMode) {
            MatchMode::EQUALS       => $query->where($fieldName, $value),
            MatchMode::STARTS_WITH  => $query->whereLike($fieldName, "$value%"),
            MatchMode::ENDS_WITH    => $query->whereLike($fieldName, "%$value"),
            MatchMode::CONTAINS     => $query->whereLike($fieldName, "%$value%"),
            MatchMode::NOT_CONTAINS => $query->whereNotLike($fieldName, "%$value%"),
            MatchMode::NOT_EQUALS   => $query->whereNot($fieldName, $value),
            MatchMode::IN           => $query->whereIn($fieldName, $value),
            MatchMode::NOT_IN       => $query->whereNotIn($fieldName, $value),
            default                 => $query,
        };
    }

    private function getValue(): string|array|null
    {
        $value = $this->parameterBag->get(['value']);
        if (! $value) {
            return null;
        }

        $value = trim($value);

        $mathMode = $this->parameterBag->matchMode();
        if ($mathMode === MatchMode::IN || $mathMode === MatchMode::NOT_IN) {
            $value = explode($this->getListSeparator(), $value);
        }

        return $value;
    }

    private function isSupportedMatchMode(MatchMode $matchMode): bool
    {
        $supportedMatchModes = [
            MatchMode::STARTS_WITH,
            MatchMode::ENDS_WITH,
            MatchMode::CONTAINS,
            MatchMode::NOT_CONTAINS,
            MatchMode::EQUALS,
            MatchMode::NOT_EQUALS,
            MatchMode::IN,
            MatchMode::NOT_IN,
        ];

        return in_array($matchMode, $supportedMatchModes);
    }
}
