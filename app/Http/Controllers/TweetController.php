<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Abraham\TwitterOAuth\TwitterOAuth;

class TweetController extends Controller
{
    public function index(Request $request){
        $id = $request->id;
        return view('tweet', compact('id'));

    }    

    public function tweet(Request $request)
    {
        $twitter = new TwitterOAuth(env('TWITTER_CONSUMER_KEY'),
        env('TWITTER_CONSUMER_SECRET'),
        env('TWITTER_CLIENT_ID_ACCESS_TOKEN'),
        env('TWITTER_CLIENT_ID_ACCESS_TOKEN_SECRET'));

        $status = substr($request->answer, 0, 40) . "\n" .url('/message') . '/' . $request->id;
        
        $ret = $twitter->post("statuses/update", [
            "status" => $status]);
            //var_dump(json_decode(json_encode($ret,320), true, 320)['errors'][0]['message']);
            return view('posted');
    }
}
