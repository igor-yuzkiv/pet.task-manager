<?php

return [
    \App\Core\Providers\AppServiceProvider::class,
    \App\Domains\User\Providers\UserServiceProvider::class,
    \App\Domains\Project\Providers\ProjectServiceProvider::class,
    \App\Domains\Task\Providers\TaskServiceProvider::class,
];
