<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(BlogCategories::class, 'blog_category_id');
    }

    public function comments()
    {
        return $this->hasMany(PostComments::class);
    }
}
