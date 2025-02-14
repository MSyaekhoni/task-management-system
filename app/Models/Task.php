<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    /** @use HasFactory<\Database\Factories\TaskFactory> */
    use HasFactory;

    protected $fillable = ['title', 'creator_id', 'description', 'category', 'priority', 'status', 'due_date'];

    protected $with = ['creator'];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
