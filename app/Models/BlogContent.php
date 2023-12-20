<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
