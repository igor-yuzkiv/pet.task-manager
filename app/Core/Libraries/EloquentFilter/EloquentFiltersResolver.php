<?php

namespace App\Core\Libraries\EloquentFilter;

use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

/**
 * @example $schema = filterAlias(attribute1:value1,matchMode:contains);
 * @example $modelFilters = ['filterAlias' => \Instance\Of\EloquentFilter::class]
 */
final class EloquentFiltersResolver
{
    public function resolveModelFiltersFromSchema(string $schema, array $modelFilters): EloquentFilter
    {
        $this->validateFilterSchema($schema);

        $filterAlias = $this->getFilterAliasFromSchema($schema);

        if (! array_key_exists($filterAlias, $modelFilters)) {
            throw new InvalidArgumentException("Filter {$filterAlias} not found");
        }

        $pramsBag = $this->resolveParameterBagFromSchema($schema);

        $filterOptions = is_array($modelFilters[$filterAlias])
            ? array_pad($modelFilters[$filterAlias], 2, [])
            : [$modelFilters[$filterAlias], []];

        /** @var EloquentFilter $filterInstance */
        $filterInstance = app($filterOptions[0], $filterOptions[1]);
        $filterInstance->setParameterBag($pramsBag);

        return $filterInstance;
    }

    public function resolveParameterBagFromSchema(string $schema): ParameterBag
    {
        preg_match('/\((.*?)\)/', $schema, $matches);
        if (! isset($matches[1])) {
            return new ParameterBag;
        }

        $attributes = [];
        foreach (explode(',', $matches[1]) as $attribute) {
            [$name, $value] = array_pad(explode(':', $attribute), 2, '');

            $name = trim($name) ?: null;
            $value = trim($value) ?: null;

            if (! $name && ! $value) {
                continue;
            }

            if (! $value) {
                $attributes[] = $name;

                continue;
            }

            $attributes[$name] = trim($value) ?: null;
        }

        return new ParameterBag($attributes);
    }

    public function getFilterAliasFromSchema(string $schema): string
    {
        return strstr($schema, '(', true) ?: $schema;
    }

    public function validateFilterSchema(string|array $schema): string|array
    {
        $rules = is_array($schema)
            ? ['schema' => 'array', 'schema.*' => $this->getSchemaValidationRule()]
            : ['schema' => $this->getSchemaValidationRule()];

        return Validator::validate(['schema' => $schema], $rules)['schema'];
    }

    public function getSchemaValidationRule(): array
    {
        return ['string', 'regex:/^[a-zA-Z_]+\(([^)]+)\)$/'];
    }
}
