<?php

namespace App\Domains\Project\Services;

use App\Domains\Project\Models\Project;
use Illuminate\Support\Str;

readonly class GenerateProjectKey
{
    public function handle(string $projectName): string
    {
        if (! $projectName) {
            throw new \InvalidArgumentException('Project name cannot be empty');
        }

        $key = $this->prepareKey($projectName);
        $counter = 1;

        while (Project::where('key', $key.'-'.$counter)->exists()) {
            $counter++;
        }

        return $key.'-'.$counter;
    }

    private function prepareKey(string $projectName): string
    {
        $words = explode(' ', Str::words($projectName, 3, ''));

        if (count($words) === 1) {
            return Str::substr(Str::upper($words[0]), 0, 3);
        }

        return collect($words)
            ->map(fn (string $word) => Str::substr(Str::upper($word), 0, 1))
            ->join('');
    }
}
