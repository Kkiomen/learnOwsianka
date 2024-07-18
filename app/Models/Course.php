<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'image', 'language', 'sort', 'activated', 'image_alt', 'slug'];

    protected function casts(): array
    {
        return [
            'tree' => 'array',
        ];
    }

    public function courseCategories(): HasMany
    {
        return $this->hasMany(CourseCategory::class, 'course_id');
    }

    public function courseCategoriesByLanguage(): Collection
    {
        return $this->courseCategories()->where('language', env('LANGUAGE'))->where('course_id', $this->id)->orderBy('sort', 'asc')->get();
    }
}
