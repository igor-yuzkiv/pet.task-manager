<?php

namespace App\Core\Providers;

use App\Core\Console\Commands\DebugCommand;
use App\Libraries\EloquentFilter\EloquentFiltersResolver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(EloquentFiltersResolver::class, function () {
            return new EloquentFiltersResolver;
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->commands([
            DebugCommand::class,
        ]);
    }
}
