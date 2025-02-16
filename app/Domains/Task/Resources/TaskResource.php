<?php

namespace App\Domains\Task\Resources;

use App\Domains\Project\Resources\ProjectResource;
use App\Domains\Task\Models\Task;
use App\Domains\User\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Task */
class TaskResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'           => (string) $this->id,
            'project_id'   => (string) $this->project_id,
            'task_list_id' => (string) $this->task_list_id,
            'name'         => $this->name,
            'key'          => $this->key,
            'description'  => $this->description,
            'status'       => $this->status,
            'priority'     => $this->priority,
            'due_date'     => $this->due_date,

            'owners'  => UserResource::collection($this->whenLoaded('owners')),
            'project' => new ProjectResource($this->whenLoaded('project')),
        ];
    }
}
