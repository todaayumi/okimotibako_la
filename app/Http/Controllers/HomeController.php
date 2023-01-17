<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \App\Post;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $id = Auth::id();
        $posts = Post::where('check', 0)->where('user_id', $id)->orderBy('created_at', 'desc')->get();
        return view('home', compact('posts'));
    }

    public function check(Request $request){
        
           $auth_id = Auth::id();
           $posts = Post::where('check', 0)->where('user_id', $auth_id)->get();
           $id = $request->id;
           Post::where('id', $id)->update(['check'=>1]);
           return back();
    }
}
