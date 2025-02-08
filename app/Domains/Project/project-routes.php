<?php

Route::group(
    [
        'prefix'     => 'api/projects',
        'middleware' => ['web', 'auth'],
        'controller' => \App\Domains\Project\Http\Controllers\ProjectController::class,
    ],
    function () {
        Route::get('', 'index');
    }
);
