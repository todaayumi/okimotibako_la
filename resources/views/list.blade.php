@extends('layouts.app')

@section('content')
<div class="container">
<h3>{{$name}}さんの受け取ったメッセージ</h3>
@foreach($posts as $post)
<div class="">
<p class="text-muted mb-1">{{ $post->created_at }}</p>
<p class="mb-1">{!! nl2br(e($post->message)) !!}</p>
</div>
@endforeach

</div>
<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
@endsection

