<?php

use App\Http\Controllers\AccountController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;

// Home Page
Route::get('/',[HomeController::class, 'index'])->name('home');


Route::match(['get', 'post'], '/make-listing', [AccountController::class, 'makeListing'])->name('makeListing');



Route::get('/subcategories/{category}', [AccountController::class, 'getSubcategories'])->name('subcategories.byCategory');
Route::post('/save-post', [AccountController::class, 'savePost'])->name('savePost');


// web.php
 Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

 // routes/web.php
Route::get('/search', [PostController::class, 'search'])->name('search');

Route::get('/api/subcategories/{category}', function($categoryId) {
    return \App\Models\Subcategory::where('category_id', $categoryId)->get();
});


// Route::get('/autocomplete', [App\Http\Controllers\SearchController::class, 'autocomplete']);
Route::get('/autocomplete', [PostController::class, 'autocomplete'])->name('autocomplete');