<?php

namespace App\Domains\Project\Models;

use App\Domains\Project\Enums\ProjectStatus;
use App\Domains\Task\Models\Task;
use App\Domains\User\Models\User;
use App\Libraries\EloquentFilter\Filters\IntegerFilter;
use App\Libraries\EloquentFilter\Filters\IsNotNullFilter;
use App\Libraries\EloquentFilter\Filters\IsNullFilter;
use App\Libraries\EloquentFilter\Filters\TextFilter;
use App\Libraries\EloquentFilter\FiltersAttribute;
use App\Libraries\EloquentFilter\HasFilters;
use Database\Factories\ProjectFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

#[FiltersAttribute([
    'text'      => TextFilter::class,
    'integer'   => IntegerFilter::class,
    'isNull'    => IsNullFilter::class,
    'isNotNull' => IsNotNullFilter::class,
])]
class Project extends Model
{
    use HasFactory, HasFilters, SoftDeletes;

    protected $table = 'projects';

    protected $fillable = [
        'key',
        'name',
        'description',
        'status',
    ];

    protected $casts = [
        'id'     => 'string',
        'status' => ProjectStatus::class,
    ];

    public function owners(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'project_owners', 'project_id', 'user_id');
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class, 'project_id', 'id');
    }

    public static function newFactory(): ProjectFactory
    {
        return ProjectFactory::new();
    }
}
