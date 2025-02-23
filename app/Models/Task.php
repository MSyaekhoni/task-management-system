<?php

namespace App\Models;

use App\Models\User;
use App\Models\StatusTask;
use Illuminate\Support\Str;
use App\Models\CategoryTask;
use App\Models\PriorityTask;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    /** @use HasFactory<\Database\Factories\TaskFactory> */
    use HasFactory;

    protected $fillable = ['title', 'slug', 'creator_id', 'description', 'category_id', 'priority_id', 'status_id', 'due_date'];

    protected $with = ['creator', 'category', 'priority', 'status']; //Eager Loading

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(CategoryTask::class);
    }

    public function priority(): BelongsTo
    {
        return $this->belongsTo(PriorityTask::class);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(StatusTask::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($task) {
            $task->slug = self::generateUniqueSlug($task->title);
        });
    }

    private static function generateUniqueSlug($title)
    {
        $slug = Str::slug($title);
        $count = self::where('slug', 'LIKE', "{$slug}%")->count();
        return $count ? "{$slug}-" . ($count + 1) : $slug;
    }
}
