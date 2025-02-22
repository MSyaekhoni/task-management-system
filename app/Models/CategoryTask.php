<?php

namespace App\Models;

use App\Models\Task;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CategoryTask extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryTaskFactory> */
    use HasFactory;

    protected $fillable = ['name', 'slug'];

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class, 'category_id');
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            $category->slug = self::generateUniqueSlug($category->name);
        });
    }

    private static function generateUniqueSlug($name)
    {
        $slug = Str::slug($name);
        $count = self::where('slug', 'LIKE', "{$slug}%")->count();
        return $count ? "{$slug}-" . ($count + 1) : $slug;
    }
}
