<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    // Define fillable fields if using mass assignment
    protected $fillable = [
        'title', 'description', 'category_id', 'subcategory_id', 'location',
        'latitude', 'longitude', 'price', 'contact_name', 'email', 'phone', 'tags'
    ];

    // Relationship: One post has many images
    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
