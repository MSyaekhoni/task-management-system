<?php

namespace App\Models;

use App\Models\Task;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PriorityTask extends Model
{
    /** @use HasFactory<\Database\Factories\PriorityTaskFactory> */
    use HasFactory;

    protected $fillable = ['name', 'slug', 'color'];

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class, 'priority_id');
    }
}
