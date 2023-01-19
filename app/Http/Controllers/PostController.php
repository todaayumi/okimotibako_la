<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request as PostRequest;
use Request;
use \App\Post;
use \App\User;

class PostController extends Controller
{
    public function index($id){

        $name = User::where('id', $id)->value('name');
        $caption = User::where('id', $id)->value('caption');
        return view('box', compact('id', 'name', 'caption'));
    }

    public function post(PostRequest $request){

        $rules = ['message' => ['required']];
        $this->validate($request, $rules);

        // $xForwardedFor = $request->header('X-Forwarded-For');
        // $ips = explode(',', $xForwardedFor);
        // $clientIp = $ips[0];

        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
            if (array_key_exists($key, $_SERVER) === true){
                foreach (explode(',', $_SERVER[$key]) as $ip){
                    $ip = trim($ip); // just to be safe
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
                       $ip = $ip;
                    }
                }
            }
        }

        $posts = new Post();
        $posts->message = $request->message;
        $posts->user_id = $request->user_id;
        $posts->ip = $request->ip();
        $posts->proxy = $ip;
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
