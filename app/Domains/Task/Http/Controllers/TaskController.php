<?php

namespace App\Domains\Task\Http\Controllers;

use App\Core\Http\Controllers\Controller;
use App\Domains\Task\Models\Task;
use App\Domains\Task\Repository\TaskRepositoryInterface;
use App\Domains\Task\Resources\TaskResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TaskController extends Controller
{
    public function __construct(private readonly TaskRepositoryInterface $taskRepository) {}

    public function index(Request $request): AnonymousResourceCollection
    {
        $response = $this->taskRepository->paginate($request->input('per_page', 10));

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
