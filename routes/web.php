<?php

use App\Http\Controllers\AccountController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

// Home Page
Route::get('/',[HomeController::class, 'index'])->name('home');


Route::match(['get', 'post'], '/make-listing', [AccountController::class, 'makeListing'])->name('makeListing');



Route::get('/subcategories/{category}', [AccountController::class, 'getSubcategories'])->name('subcategories.byCategory');
Route::post('/save-post', [AccountController::class, 'savePost'])->name('savePost');


