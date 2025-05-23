<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id', 'image_path'
    ];

    // Relationship: Image belongs to a post
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
