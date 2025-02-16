<?php

namespace App\Core\Console\Commands;

use App\Domains\Project\Models\Project;
use Illuminate\Console\Command;

class DebugCommand extends Command
{
    protected $signature = 'debug';

    protected $description = 'Command description';

    public function handle(): void
    {
        $projects = Project::query()
            ->filter([
                'text(name:status,value:open|in_progress,matchMode:in)',
                'text(name:key,value:-1,matchMode:endsWith)',
            ])
            ->get();

        dd($projects->toArray());

    }
}
