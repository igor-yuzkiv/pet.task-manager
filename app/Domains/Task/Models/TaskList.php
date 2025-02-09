<?php

namespace App\Domains\Task\Models;

use Database\Factories\TaskListFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TaskList extends Model
{
    use HasFactory;

    protected $table = 'task_lists';

    protected $fillable = [
        'project_id',
        'name',
    ];

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class, 'task_list_id', 'id');
    }

    public static function newFactory(): TaskListFactory
    {
        return TaskListFactory::new();
    }
}
