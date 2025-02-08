<?php

namespace App\Domains\Project\Resources;

use App\Domains\Project\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Project */
class ProjectResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'          => (string) $this->id,
            'key'         => $this->key,
            'name'        => $this->name,
            'description' => $this->description,
        ];
    }
}
