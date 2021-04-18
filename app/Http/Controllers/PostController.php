<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Post;
use \App\User;

class PostController extends Controller
{
    public function index($id){

        $name = User::where('id', $id)->value('name');
        return view('box', compact('id', 'name'));
    }

    public function post(Request $request){

        $posts = new Post();
        $posts->message = $request->message;
        $posts->user_id = $request->user_id;
        $posts->ip = $request->ip();
        $posts->save();

        return redirect('/posted');
    }

    public function posted(){
        return view('posted');
    }

    public function message($message_id){
        $message = Post::where('id', $message_id)->value('message');
        return view('message', compact('message'));
    }
}
