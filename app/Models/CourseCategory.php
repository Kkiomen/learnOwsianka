<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class CourseCategory extends Model
{
    use HasFactory;
    protected $fillable = ['course_id', 'name', 'language', 'sort'];

    public function blogs()
    {
        return CourseCategoryLesson::where('course_category_id', $this->id)->orderBy('sort', 'asc')->get();
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
