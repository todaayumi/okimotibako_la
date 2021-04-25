@extends('layouts.app')

@section('content')
<div class="container">

<div class="container">
		<div class="mx-auto text-center">
	<h4 class="text-center my-3 mark d-inline-block">{{ $name }}さんのおきもち箱</h4>
</div>
	<form action="" method="post" id="box">
    @csrf
    <div class="form-group">
    <textarea class="form-control" name="message" rows="6"></textarea>
    </div>
    <input type="hidden" value="{{ $id }}" name="user_id">
	<p class="mx-auto text-center"><a data-toggle="modal" data-target="#exampleModal">
  利用規約
</a>に同意して
<input class="btn btn-danger btn-sm" type="submit" value="送信" name="send">
</p>

</form>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">利用規約</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        おきもち箱運営は、おきもち箱（以降、当サービス）について以下を定めます。当サービス登録ユーザー（以降、ユーザー）、ユーザーに対し投稿した者（以下、投稿者）は利用規約に同意したものとします。<br><br>
			・匿名で送信されたメッセージは本人確認が困難であるため、送信されたメッセージに関する知的財産権は、メッセージを受け取った者に帰属するものとします。<br>
			・匿名で送信されたメッセージは後に公開して返信されることを想定しています。公開されたら困る内容は書きこまないでください。<br>
			・当サービスで起こったユーザー間、ユーザーと投稿者間の紛争に関し、当サービスは一切責任を負いかねます。<br>
			・当サービスの停止・終了・譲渡は当サービス運営が自由に行えるものとします。<br>
			・ユーザーの個人情報、投稿者の個人情報、投稿されたメッセージの内容は警察等の捜査機関に依頼された場合提出することがあります。<br>
			・誹謗中傷、個人情報、犯罪または犯罪を助長する内容、他社の権利を侵害する内容、その他当サービス運営が不適切だと判断する内容を含むメッセージの送信は禁止です。<br>
		・当サービス及びユーザーにとって著しく不利益となる行為を禁じます。
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
      </div>
    </div>
  </div>
</div>

</div>
@endsection