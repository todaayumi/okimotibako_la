<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \App\Post;
use \App\User;

class TimelineController extends Controller
{
    public function edit(){

        $id = Auth::id();
        $caption = User::where('id', $id)->value('caption');
        return view('auth.edit_caption', compact('caption'));

    }

    public function edit_done(Request $request ){

        $id = Auth::id();
        User::where('id', $id)->update(['caption' => $request->caption,]);

        return redirect('home');
    }


    
}
