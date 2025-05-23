<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Trip;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    
public function index()
{

    $featuredPosts = Post::where('is_featured', 1)
                         ->where('status', 'active')
                         ->with('images') // if using images
                         ->latest()
                         ->take(6)
                         ->get();

$latestPosts = Post::with(['category', 'subcategory', 'images'])
                   ->orderBy('created_at', 'desc')
                   ->take(6)
                   ->get();

    return view('front.home', compact('featuredPosts', 'latestPosts'));

}
  

}
