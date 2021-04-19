<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \App\Post;

class TimelineController extends Controller
{
    public function index(){

        $posts = Post::where('check', 0)->get();
        return view('auth.timeline', compact('posts'));
    }

    public function check(Request $request){

        $posts = Post::where('check', 0)->get();
        $id = $request->id;
        Post::where('id', $id)->update(['check'=>1]);
        return view('auth.timeline', compact('posts'));
    }

    
}
