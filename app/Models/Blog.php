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
        'activated'
    ];

    public function contents(): HasMany
    {
        return $this->hasMany(BlogContent::class)->orderBy('sequence', 'asc');
    }
}
