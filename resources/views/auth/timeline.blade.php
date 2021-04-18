@extends('layouts.app')

@section('content')
<div class="container">
<a href="/box/{{ Auth::id() }}">質問箱へ</a>
@foreach($posts as $post)
<div class="">
<p class="text-muted mb-1">{{ $post->created_at }}</p>
<p class="mb-1">{!! nl2br(e($post->message)) !!}</p>
<p class="text-muted">{{ $post->ip }} <a href="//twitter.com/share" class="twitter-share-button" data-text="{{ Str::substr($post->message, 0, 20) }}" data-url="http://http://127.0.0.1:8000/messege/{{ $post->id }}" data-lang="en">
          Tweet</a></p>
</div>
@endforeach

</div>
<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
@endsection

