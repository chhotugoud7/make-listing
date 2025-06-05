<?php

use App\Http\Controllers\AccountController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Filament\Pages\ImportData;

// GET route to display the import page
Route::get('/admin/import-data', ImportData::class)
    ->middleware(['auth'])
    ->name('filament.admin.pages.import-data');

// POST routes to handle each import form submission
Route::post('/admin/import-data/categories', [ImportData::class, 'submitCategories'])
    ->middleware(['auth'])
    ->name('filament.pages.import-data.submitCategories');



    
Route::post('/admin/import-data/subcategories', [ImportData::class, 'submitSubcategories'])
    ->middleware(['auth'])
    ->name('filament.pages.import-data.submitSubcategories');

Route::post('/admin/import-data/posts', [ImportData::class, 'submitPosts'])
    ->middleware(['auth'])
    ->name('filament.pages.import-data.submitPosts');


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