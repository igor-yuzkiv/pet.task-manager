<?php

namespace App\Domains\Project\Providers;

use Illuminate\Support\ServiceProvider;

class ProjectServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../project-routes.php');
    }
}
