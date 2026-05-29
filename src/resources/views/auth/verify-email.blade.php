@extends('layouts.app')

@section('content')

<div class="verify-box">
   
   <img src="/images/logo.svg">

   <p>
    登録していただいたメールアドレスに認証メールを送付しました。
   </p>

   <p>
    メール認証を完了してください。
   </p>

   <a href="http://localhost:8025">
    認証はこちらから
   </a>

   <form method="POST" action="{{ route('verification.send') }}">
     @csrf

     <button>
        認証メールを再送する
     </button>
   </form>
</div>

@endsection