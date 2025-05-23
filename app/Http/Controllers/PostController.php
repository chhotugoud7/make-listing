<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;

class PostController extends Controller
{
    //
    // PostController.php
public function show(Post $post)
{
    return view('posts.show', compact('post'));
}


public function search(Request $request)
{
    $query = Post::query();

    // Filter by category
    if ($request->filled('category_id')) {
        $query->where('category_id', $request->category_id);
    }

    // Filter by subcategory
    if ($request->filled('subcategory_id')) {
        $query->where('subcategory_id', $request->subcategory_id);
    }

    // Filter by location (fuzzy)
    if ($request->filled('location')) {
        $query->where('location', 'LIKE', '%' . $request->location . '%');
    }

    // Filter by price range
    if ($request->filled('min_price')) {
        $query->where('price', '>=', $request->min_price);
    }
    if ($request->filled('max_price')) {
        $query->where('price', '<=', $request->max_price);
    }

    // Filter by text search (title or description)
    if ($request->filled('search_text')) {
        $search = $request->search_text;
        $query->where(function ($q) use ($search) {
            $q->where('title', 'LIKE', '%' . $search . '%')
              ->orWhere('description', 'LIKE', '%' . $search . '%');
        });
    }

    // Filter by tags (simple fuzzy search in tags column)
    if ($request->filled('tags')) {
        $tags = explode(',', $request->tags);
        $query->where(function ($q) use ($tags) {
            foreach ($tags as $tag) {
                $q->orWhere('tags', 'LIKE', '%' . trim($tag) . '%');
            }
        });
    }

    // Sorting
    if ($request->filled('sort')) {
        switch ($request->sort) {
            case 'latest':
                $query->orderBy('created_at', 'desc');
                break;
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }
    } else {
        $query->orderBy('created_at', 'desc');
    }

    // Pagination
    $posts = $query->paginate(9)->withQueryString();

    // Get categories and subcategories for filters dropdown
    $categories = Category::all();
    $subcategories = Subcategory::where('category_id', $request->category_id)->get();

    return view('search.index', compact('posts', 'categories', 'subcategories'));
}

}
