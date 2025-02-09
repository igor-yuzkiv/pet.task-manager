<?php

namespace App\Domains\Project\Providers;

use App\Domains\Project\Repository\ProjectRepository;
use App\Domains\Project\Repository\ProjectRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class ProjectServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(ProjectRepositoryInterface::class, ProjectRepository::class);
    }

    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../project-routes.php');
    }
}
