<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Post;
use \App\User;

class PostController extends Controller
{
    public function index($id){

        $name = User::where('id', $id)->value('name');
        $caption = User::where('id', $id)->value('caption');
        return view('box', compact('id', 'name', 'caption'));
    }

    public function post(Request $request){

        $rules = ['message' => ['required']];
        $this->validate($request, $rules);

        $posts = new Post();
        $posts->message = $request->message;
        $posts->user_id = $request->user_id;
        $posts->ip = $request->ip();
        $posts->proxy = $request->header('X-Forword-For'); 
        $posts->save();

        return redirect('/posted');
    }

    public function posted(){
        return view('posted');
    }

    public function message($message_id){

        $message = Post::where('id', $message_id)->value('message');
        $message_id = $message_id;
        return view('message', compact('message', 'message_id'));
    }

    public function list($id){

        $name = User::where('id', $id)->value('name');
        $posts = Post::where('user_id', $id)->orderBy('created_at', 'desc')->get();
        return view('list', compact('name', 'posts'));
    }

    public function ogp($message_id){

        $message = Post::where('id', $message_id)->value('message');

        $w = 600;
        $h = 315;
        // １行の文字数
        $partLength = 30;

        $fontSize = 13;
        $fontPath = public_path('font/ipaexm.ttf');

        // 画像を作成
        $image = \imagecreatetruecolor($w, $h);
        // 背景画像を描画
        $bg = \imagecreatefromjpeg(public_path('img/background.jpg'));
        imagecopyresampled($image, $bg, 0, 0, 0, 0, $w, $h, 800, 533);

        // 色を作成
        $white = imagecolorallocate($image, 0, 0, 0);

        // 各行に分割
        $parts = [];
        $length = mb_strlen($message);
        for ($start = 0; $start < $length; $start += $partLength) {
            $parts[] = mb_substr($message, $start, $partLength);
        }

        // テキストを描画
        $this->drawParts($image, $parts, $w, $h, $fontSize, $fontPath, $white);

        ob_start();
        imagepng($image);
        $content = ob_get_clean();

        // 画像としてレスポンスを返す
        return response($content)
            ->header('Content-Type', 'image/png');
    }


        
    private function drawParts($image, $parts, $w, $h, $fontSize, $fontPath, $color, $offset = 0)
    {
        foreach ($parts as $i => $part) {
            // サイズを計算
            $box = \imagettfbbox($fontSize, 0, $fontPath, $part);
            $boxWidth = $box[4] - $box[6];
            $boxHeight = $box[1] - $box[7];
            // 位置を計算
            $x = ($w - $boxWidth) / 2;
            $y = $h / 2 + $boxHeight / 2 - $boxHeight * count($parts) * 0.5 + $boxHeight * $i;
            \imagettftext($image, $fontSize, 0, $x + $offset, $y + $offset, $color, $fontPath, $part);
        }

    }

    public function info(){
        return view('info');
    }
}
