<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    
public function index()
{
    return view('front.home');
}
  

}
