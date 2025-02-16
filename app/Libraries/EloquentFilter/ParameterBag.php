<?php

namespace App\Libraries\EloquentFilter;

final class ParameterBag
{
    public function __construct(
        protected array $parameters = []
    ) {}

    public function get(string|int|array $name, mixed $default = null): mixed
    {
        if (is_array($name)) {
            $result = $default;
            foreach ($name as $key) {
                if ($this->has($key)) {
                    $result = $this->parameters[$key];
                    break;
                }
            }

            return $result;
        }

        return $this->parameters[$name] ?? null;
    }

    public function has(string|int $name): bool
    {
        return isset($this->parameters[$name]);
    }

    public function boolean(string|int|array $name): bool
    {
        return boolval($this->get($name));
    }

    public function matchMode(?MatchMode $default = null): ?MatchMode
    {
        $value = $this->get('matchMode');
        if (empty($value)) {
            return $default;
        }

        return MatchMode::tryFrom(trim($value)) ?? $default;
    }

    public function toArray(): array
    {
        return $this->parameters;
    }
}
