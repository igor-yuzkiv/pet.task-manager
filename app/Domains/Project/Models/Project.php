<?php

namespace App\Domains\Project\Models;

use App\Domains\Project\Enums\ProjectStatus;
use App\Domains\User\Models\User;
use Database\Factories\ProjectFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'projects';

    protected $fillable = [
        'key',
        'name',
        'description',
        'status',
    ];

    protected $casts = [
        'status' => ProjectStatus::class,
    ];

    public function owners(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'project_owners', 'project_id', 'user_id');
    }

    public static function newFactory(): ProjectFactory
    {
        return ProjectFactory::new();
    }
}
