@extends('layouts.app')

@section('content')
<div class="container">
  <form method="post" action="">
  <div class="form-group">

      <textarea class="form-control" id="exampleFormControlTextarea1" rows="6" name="answer"></textarea>
      <input type="hidden" value={{ $id }} name="id">
      <button type="submit" class="btn btn-primary">post</button>

    </div>
  </form>
</div>

</div>
@endsection