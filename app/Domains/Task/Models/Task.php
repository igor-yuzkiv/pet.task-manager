<?php

namespace App\Domains\Task\Models;

use App\Core\Libraries\EloquentFilter\Filters\IntegerFilter;
use App\Core\Libraries\EloquentFilter\Filters\IsNotNullFilter;
use App\Core\Libraries\EloquentFilter\Filters\IsNullFilter;
use App\Core\Libraries\EloquentFilter\Filters\TextFilter;
use App\Core\Libraries\EloquentFilter\FiltersAttribute;
use App\Core\Libraries\EloquentFilter\HasFilters;
use App\Domains\Project\Models\Project;
use App\Domains\Task\Enums\Priority;
use App\Domains\Task\Enums\TaskStatus;
use App\Domains\User\Models\User;
use Database\Factories\TaskFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[FiltersAttribute([
    'text'      => TextFilter::class,
    'integer'   => IntegerFilter::class,
    'isNull'    => IsNullFilter::class,
    'isNotNull' => IsNotNullFilter::class,
])]
class Task extends Model
{
    use HasFactory, HasFilters;

    protected $table = 'tasks';

    protected $fillable = [
        'project_id',
        'task_list_id',
        'name',
        'key',
        'description',
        'status',
        'priority',
        'due_date',
    ];

    protected $casts = [
        'status'   => TaskStatus::class,
        'priority' => Priority::class,
        'due_date' => 'datetime',
    ];

    public function project(): HasOne
    {
        return $this->hasOne(Project::class, 'id', 'project_id');
    }

    public function taskList(): HasOne
    {
        return $this->hasOne(TaskList::class, 'id', 'task_list_id');
    }

    public function owners(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'task_owners', 'task_id', 'user_id');
    }

    public static function newFactory(): TaskFactory
    {
        return TaskFactory::new();
    }
}
