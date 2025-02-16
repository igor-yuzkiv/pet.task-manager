<?php

namespace App\Domains\Project\Http\Controllers;

use App\Core\Http\Controllers\Controller;
use App\Domains\Project\Http\Requests\ProjectRequest;
use App\Domains\Project\Models\Project;
use App\Domains\Project\Repository\ProjectRepositoryInterface;
use App\Domains\Project\Resources\ProjectResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProjectController extends Controller
{
    public function __construct(
        private readonly ProjectRepositoryInterface $projectRepository
    ) {}

    public function index(Request $request): AnonymousResourceCollection
    {
        $projects = $this->projectRepository->paginate($request->input('per_page', 10));

        return ProjectResource::collection($projects);
    }

    public function show(Project $project): ProjectResource
    {
        ProjectResource::withoutWrapping();

        return ProjectResource::make($project);
    }

    public function create(ProjectRequest $request): ProjectResource
    {
        $project = $this->projectRepository->create($request->validated());

        return new ProjectResource($project);
    }

    public function update(Project $project, ProjectRequest $request): ProjectResource
    {
        $project = $this->projectRepository->update($project, $request->validated());

        return new ProjectResource($project);
    }

    public function destroy(Project $project): JsonResponse
    {
        $isDeleted = $project->delete();

        return response()->json([
            'status'  => $isDeleted,
            'message' => $isDeleted ? 'Project deleted' : 'Failed to delete project',
        ], $isDeleted ? 200 : 400);
    }
}
