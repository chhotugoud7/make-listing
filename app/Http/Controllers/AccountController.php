<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\ResetPasswordEmail;
use App\Models\Category;
use App\Models\Post;
use App\Models\Subcategory;

use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

//if needed remove this db facades later


class AccountController extends Controller
{

    public function makeListing() {
   
         $categories = Category::with('subcategories')->get();
    return view('front.list.create', compact('categories'));
    }

        
    public function getSubcategories($categoryId)
    {
        $subcategories = Subcategory::where('category_id', $categoryId)->get();
        return response()->json($subcategories);
    }


    public function savePost(Request $request)
{
    $rules = [
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'category_id' => 'required|exists:categories,id',
        'subcategory_id' => 'nullable|exists:subcategories,id',
        'location' => 'required|string',
        // 'price' => 'nullable|numeric|min:0',
        'contact_name' => 'required|string|max:255',
        'email' => 'required|email',
        'phone' => 'required|string|max:20',
        'tags' => 'nullable|string',
        'images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ];

    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
        return response()->json([
            'status' => false,
            'errors' => $validator->errors(),
        ]);
    }

    // Create Post (no user_id since public form)
    $post = new Post();
    $post->title = $request->title;
    $post->description = $request->description;
    $post->category_id = $request->category_id;
    $post->subcategory_id = $request->subcategory_id;
    $post->location = $request->location;
    $post->latitude = $request->latitude;
    $post->longitude = $request->longitude;
    // $post->price = $request->price;
    $post->contact_name = $request->contact_name;
    $post->email = $request->email;
    $post->phone = $request->phone;
    $post->tags = $request->tags;
    $post->save();

    // Handle images
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {
            $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('posts', $filename, 'public');

            // If you're using a PostImage model/table:
            $post->images()->create([
                'image_path' => $path,
            ]);
        }
    }

    // Optional flash message (won't show unless session is used in view)
    session()->flash('success', 'Post created successfully.');

    return Response()->json([
        'status' => true,
        'errors' => [],
    ]);
}






}