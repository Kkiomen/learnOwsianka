<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
      'social_post_id', 'social_type', 'image', 'text', 'tags', 'sended', 'language'
    ];
}
