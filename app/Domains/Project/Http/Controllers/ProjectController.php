<?php

namespace App\Domains\Project\Http\Controllers;

use App\Core\Http\Controllers\Controller;
use App\Domains\Project\Models\Project;
use App\Domains\Project\Resources\ProjectResource;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        return ProjectResource::collection(Project::paginate(
            perPage: $request->input('per_page', 10)
        ));
    }

    public function create() {}

    public function store(Request $request) {}

    public function show(Project $project) {}

    public function edit(Project $project) {}

    public function update(Request $request, Project $project) {}

    public function destroy(Project $project) {}
}
