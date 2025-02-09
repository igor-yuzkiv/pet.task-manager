<?php

namespace App\Domains\User\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Domains\Project\Models\Project;
use App\Domains\Task\Models\Task;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    protected function ownProjects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'project_owners', 'user_id', 'project_id');
    }

    protected function tasks(): BelongsToMany
    {
        return $this->belongsToMany(Task::class, 'task_owners', 'user_id', 'task_id');
    }

    public static function newFactory(): UserFactory
    {
        return UserFactory::new();
    }
}
