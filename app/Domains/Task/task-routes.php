<?php

use App\Domains\Task\Http\Controllers\TaskController;

Route::group(
    [
        'prefix'     => 'api/tasks',
        'middleware' => ['web', 'auth'],
        'controller' => TaskController::class,
    ],
    function () {
        Route::get('', 'index')->name('api.tasks.index');
        Route::get('{task}', 'show')->name('api.tasks.show');
        Route::post('', 'store')->name('api.tasks.create');
        Route::put('{task}', 'update')->name('api.tasks.update');
        Route::delete('{task}', 'destroy')->name('api.tasks.destroy');
    }
);
