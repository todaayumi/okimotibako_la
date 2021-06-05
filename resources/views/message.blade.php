@extends('layouts.app')

@section('additionalMeta')
<meta property="og:image" content="{{ url()->current() }}/ogp.png">
<meta name="twitter:card" content="summary">
<meta name="twitter:image" content="{{ url()->current() }}/ogp.png">
@endsection

@section('content')
<div class="container">
<div class="card">
  <div class="card-body">
    {!! nl2br(e($message)) !!}
  </div>
</div>

</div>
@endsection