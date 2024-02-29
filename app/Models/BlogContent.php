<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BlogContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'blog_id',
        'header',
        'content',
        'image_url',
        'image_alt',
        'sequence',
        'type'
    ];

    public function courseCategoryLesson(): BelongsTo
    {
        return $this->belongsTo(CourseCategoryLesson::class, 'blog_content_id');
    }

    public function courseCategory(): BelongsTo
    {
        return $this->belongsTo(CourseCategory::class, 'course_category_id');
    }
}
