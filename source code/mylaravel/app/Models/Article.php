<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    protected $fillable = [
        'title', 'content', 'image', 'author', 'published_at'
    ];


    use HasFactory;

    // Mối quan hệ với các bình luận
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
