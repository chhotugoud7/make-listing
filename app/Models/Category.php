<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Subcategory;  // <-- add this line

class Category extends Model
{
    protected $fillable = ['name', 'slug'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });
    }

    public function subcategories()
    {
        return $this->hasMany(Subcategory::class); // now it works
    }

    protected static function booted()
{
    static::deleting(function ($category) {
        $category->subcategories()->delete(); // Delete related subcategories
    });
}
}
