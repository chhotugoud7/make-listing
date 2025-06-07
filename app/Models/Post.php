<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes; // Add this

class Post extends Model
{
    use HasFactory, SoftDeletes; // Add SoftDeletes here
    // Define fillable fields for mass assignment
    protected $fillable = [
        'title', 'description', 'category_id', 'subcategory_id', 'location',
        'latitude', 'longitude', 'contact_name', 'email', 'phone', 'tags',
        'is_featured',  // Added this
        'status',       // Added this
    ];

    // Relationship: One post has many images
    public function images()
    {
        return $this->hasMany(Image::class);
    }

    // Relationships for category and subcategory
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }
}
