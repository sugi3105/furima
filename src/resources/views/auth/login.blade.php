@extends('layouts.app')

@section('content')

<h2>ログイン</h2>

<form method="POST" action="/login" class="form">
  @csrf

  <input type="email" name="email" placeholder="メールアドレス">

  <input type="password" name="password" placeholder="パスワード">

  <button class="btn">ログイン</button>
</form>

@endsection