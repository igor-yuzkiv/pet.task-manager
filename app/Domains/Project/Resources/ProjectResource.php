<?php

namespace App\Domains\Project\Resources;

use App\Domains\Project\Models\Project;
use App\Domains\Task\Resources\TaskResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Project */
class ProjectResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'key'         => $this->key,
            'name'        => $this->name,
            'description' => $this->description,
            'status'      => $this->status,

            'tasks' => TaskResource::collection($this->whenLoaded('tasks')),
        ];
    }
}
