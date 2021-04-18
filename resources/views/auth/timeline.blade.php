@extends('layouts.app')

@section('content')
<div class="container">
<a href="/box/{{ Auth::id() }}">質問箱へ</a>
@foreach($posts as $post)
<div class="">
<p class="text-muted mb-1">{{ $post->created_at }}</p>
<p class="mb-1">{{ $post->message }}</p>
<p class="text-muted">{{ $post->ip }}</p>
</div>
@endforeach

</div>
@endsection