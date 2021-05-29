@extends('layouts.app')

@section('content')
<div class="container">
<form method="post" action="">
@csrf
<div class="form-group">
    <label for="exampleFormControlTextarea1">お気持ち箱のキャプションを入力してください。</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="6" name="caption">{{ $caption }}</textarea>
    <button type="submit" class="btn btn-primary">update</button>
  </div>
</form>
@endsection

