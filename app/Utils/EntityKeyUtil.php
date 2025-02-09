<?php

namespace App\Utils;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

final class EntityKeyUtil
{
    public static function generateEntityUniqKey(string $name, Model $model, string $fieldName = 'key'): string
    {
        if (! $name) {
            throw new \InvalidArgumentException('Name cannot be empty');
        }

        $key = self::generateKey($name);
        $counter = 1;

        while ($model::query()->where($fieldName, $key.'-'.$counter)->exists()) {
            $counter++;
        }

        return $key.'-'.$counter;
    }

    public static function generateKey(string $name): string
    {
        if (! $name) {
            throw new \InvalidArgumentException('Name cannot be empty');
        }

        $words = explode(' ', Str::words($name, 3, ''));

        if (count($words) === 1) {
            return Str::substr(Str::upper($words[0]), 0, 3);
        }

        return collect($words)
            ->map(fn (string $word) => Str::substr(Str::upper($word), 0, 1))
            ->join('');
    }
}
