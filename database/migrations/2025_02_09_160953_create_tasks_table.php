<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('project_id');
            $table->unsignedInteger('task_list_id')->nullable();

            $table->string('name');
            $table->string('key');
            $table->text('description')->nullable();
            $table->string('status')->default(\App\Domains\Task\Enums\TaskStatus::Open->value);
            $table->string('priority')->nullable();
            $table->dateTime('due_date')->nullable();

            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreign('task_list_id')->references('id')->on('task_lists')->onDelete('set null');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
