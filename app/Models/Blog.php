<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
