<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Log;

class TwitterLoginController extends Controller
{
    /**
       * Twitterの認証ページヘユーザーをリダイレクト
       *
       * @return \Illuminate\Http\Response
       */      
      public function redirectToProvider(){
        return Socialite::driver('twitter')->redirect();
     }   
    /**
     * Twitterからユーザー情報を取得(Callback先)
     *
     * @return \Illuminate\Http\Response
    */    
    public function handleProviderCallback()
    {
        try {
            $twitterUser=Socialite::with('twitter')->user();
        }catch (Exception $e) {
            return redirect('login/twitter');
        }
 
        $user = User::where('twitter', $twitterUser->id)->first();
 
        if($user) {
            $user->name = $twitterUser->name;
            $user->email = $twitterUser->email;
            $user->update();
        }else {
            $user = New User();
            $user->twitter = $twitterUser->id;
            $user->name = $twitterUser->name;
            $user->email = $twitterUser->email;
            $user->save();
        }
 
        Auth::login($user);
        return redirect()->to('home');
    }
}
