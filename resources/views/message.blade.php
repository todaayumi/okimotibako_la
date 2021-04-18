@extends('layouts.app')

@section('content')
<div class="container">
<div class="card">
  <div class="card-body">
    {!! nl2br(e($message)) !!}
  </div>
</div>

</div>
@endsection