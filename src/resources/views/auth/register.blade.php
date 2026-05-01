@extends('layouts.app')

@section('content')

<h2>会員登録</h2>

<form method="POST" action="/register" class="form">
  @csrf

  <input type="text" name="name" placeholder="ユーザー名">

  <input type="email" name="email" placeholder="メールアドレス">

  <input type="password" name="password" placeholder="パスワード">

  <input type="password" name="password_confirmation" placeholder="確認用パスワード">

  <button class="btn">登録</button>
</form>

@endsection