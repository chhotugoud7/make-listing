<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\ResetPasswordEmail;
use App\Models\Subscription;
use App\Models\Trip;
use App\Models\tripJoin;
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
//if needed remove this db facades later


class AccountController extends Controller
{

    public function makeListing(){
        return view('front.list.create');


    }








}