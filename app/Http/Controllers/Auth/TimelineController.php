<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \App\Post;

class TimelineController extends Controller
{
    public function index(){

        $posts = Post::latest()->get();
        return view('auth.timeline', compact('posts'));
    }

    
}
