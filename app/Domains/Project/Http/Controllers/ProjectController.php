<?php

namespace App\Domains\Project\Http\Controllers;

use App\Core\Http\Controllers\Controller;
use App\Domains\Project\Models\Project;
use App\Domains\Project\Resources\ProjectResource;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        return ProjectResource::collection(Project::all());
    }

    public function create() {}

    public function store(Request $request) {}

    public function show(Project $project) {}

    public function edit(Project $project) {}

    public function update(Request $request, Project $project) {}

    public function destroy(Project $project) {}
}
