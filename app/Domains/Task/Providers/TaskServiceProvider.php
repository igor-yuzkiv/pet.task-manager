<?php

namespace App\Domains\Task\Providers;

use App\Domains\Task\Repository\TaskRepository;
use App\Domains\Task\Repository\TaskRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class TaskServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(TaskRepositoryInterface::class, TaskRepository::class);
    }

    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../task-routes.php');
    }
}
