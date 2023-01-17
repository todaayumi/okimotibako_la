@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @section('content')
                    <div class="container">
                      <a href="/box/{{Auth::id()}}">質問箱へ</a>  
                      <a href="/list/{{Auth::id()}}">リスト へ</a> 
                      <a href="/edit_caption">キャプションを変更する</a>
                      @foreach($posts as $post)
                      <div class="">
                        <p class="text-muted mb-1">{{ $post->created_at }}</p>
                        <p class="mb-1">{!! nl2br(e($post->message)) !!}</p>
                        <p class="text-muted d-inline-block">ip : {{ $post->ip }} / proxy : {{$post->proxy}}
                        <div class="d-inline-block">
                          <form method="post" action="/home" >
                          @csrf
                          <input type="hidden" name="id" value="{{$post->id}}">
                          <input type="submit" class="btn btn-primary btn-sm" value="delete">
                        </div>
                        </form>
                        <a href="//twitter.com/share" class="twitter-share-button" data-text="" data-url="http://127.0.0.1:8000/message/{{ $post->id }}" data-lang="en">
                                  Tweet</a>
                      </div>
                      
                    </p>
                               
                      @endforeach
                      
                    </div>

                
                
            
        </div>
    </div>
</div>
@endsection
