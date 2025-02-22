<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->foreignId('creator_id')->constrained(
                table: 'users',
                indexName: 'tasks_creator_id'
            );
            $table->text('description');
            $table->foreignId('category_id')->constrained(
                table: 'category_tasks',
                indexName: 'category_task_id'
            );
            $table->enum('priority', ['Low', 'Medium', 'High'])->default('Medium');
            $table->foreignId('status_id')->constrained(
                table: 'status_tasks',
                indexName: 'status_task_id'
            );
            $table->dateTime('due_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
