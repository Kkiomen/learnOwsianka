<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'social_post_id',
        'title',
        'short_description',
        'language',
        'content',
        'tags',
        'image_url',
        'slug',
        'activated',
        'to_publish',
        'title_meta',
        'description_meta',
    ];

    public function contents(): HasMany
    {
        return $this->hasMany(BlogContent::class)->orderBy('sequence', 'asc');
    }

    public function courseCategory(): ?CourseCategory
    {
        $courseCategoryLesson = CourseCategoryLesson::where('blog_id', $this->id)->orderBy('sort', 'asc')->first();
        if(!$courseCategoryLesson){
            return null;
        }
        return CourseCategory::where('id', $courseCategoryLesson->course_category_id)->first();
    }
}
