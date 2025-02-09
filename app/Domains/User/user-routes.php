<?php

Route::group(
    [
        'prefix'     => 'api/auth',
        'middleware' => ['web', 'auth'],
        'controller' => \App\Domains\User\Http\Controllers\AuthController::class,
    ],
    function () {
        Route::post('login', 'login')->withoutMiddleware(['auth'])->name('api.auth.login');
        Route::get('me', 'me')->name('api.auth.me');
    }
);
