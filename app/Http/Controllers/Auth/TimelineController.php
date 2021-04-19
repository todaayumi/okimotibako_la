<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \App\Post;

class TimelineController extends Controller
{
    public function index(){

        $id = Auth::id();
        $posts = Post::where('check', 0)->where('user_id', $id)->get();
        return view('auth.timeline', compact('posts'));
    }

    public function check(Request $request){

        $auth_id = Auth::id();
        $posts = Post::where('check', 0)->where('user_id', $auth_id)->get();
        $id = $request->id;
        Post::where('id', $id)->update(['check'=>1]);
        return back();
    }

    
}
