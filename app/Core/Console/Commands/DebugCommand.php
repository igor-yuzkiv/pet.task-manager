<?php

namespace App\Core\Console\Commands;

use App\Domains\Project\Models\Project;
use App\Domains\Project\Resources\ProjectResource;
use Illuminate\Console\Command;

class DebugCommand extends Command
{
    protected $signature = 'debug';

    protected $description = 'Command description';

    public function handle(): void
    {

        $project = Project::first();

        $resource = ProjectResource::make($project);

    }
}
