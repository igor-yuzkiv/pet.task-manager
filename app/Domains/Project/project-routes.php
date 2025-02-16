<?php

Route::group(
    [
        'prefix'     => 'api/projects',
        'middleware' => ['web', 'auth'],
        'controller' => \App\Domains\Project\Http\Controllers\ProjectController::class,
    ],
    function () {
        Route::get('', 'index')->name('api.projects.index');
        Route::get('{project}', 'show')->name('api.projects.show');
        Route::post('', 'store')->name('api.projects.create');
        Route::put('{project}', 'update')->name('api.projects.update');
        Route::delete('{project}', 'destroy')->name('api.projects.destroy');
    }
);
