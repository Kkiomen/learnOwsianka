<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CourseCategoryLesson extends Model
{
    use HasFactory;
    protected $fillable = ['course_category_id', 'blog_id', 'sort'];

    public function blog()
    {
        return Blog::where('id', $this->blog_id)->first();
    }
}
