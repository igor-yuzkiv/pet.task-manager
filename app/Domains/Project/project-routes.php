<?php

Route::group(
    [
        'prefix'     => 'api/projects',
        'middleware' => ['web', 'auth'],
        'controller' => \App\Domains\Project\Http\Controllers\ProjectController::class,
    ],
    function () {
        Route::get('', 'index');
        Route::post('', 'create');
        Route::put('{project}', 'update');
        Route::delete('{project}', 'destroy');
    }
);
