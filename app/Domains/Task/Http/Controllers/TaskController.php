<?php

namespace App\Domains\Task\Http\Controllers;

use App\Core\Http\Controllers\ResourceController;
use App\Domains\Task\Models\Task;
use App\Domains\Task\Repository\TaskRepositoryInterface;
use App\Domains\Task\Resources\TaskResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TaskController extends ResourceController
{
    public function __construct(private readonly TaskRepositoryInterface $taskRepository) {}

    public function getModelClass(): string
    {
        return Task::class;
    }

    public function index(Request $request): AnonymousResourceCollection
    {
        $response = $this->taskRepository->paginate($this->getPerPage(), $this->getFilters());

        return TaskResource::collection($response);
    }

    public function store(Request $request) {}

    public function show(Task $task): TaskResource
    {
        return TaskResource::make($task);
    }

    public function update(Request $request, Task $task) {}

    public function destroy($id) {}
}
