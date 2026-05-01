@extends('layouts.auth')

@section('content')
<div class="auth-box">

  <div class="box-header">
    <div class="logo">COACHTECH</div>
  </div>

  <div class="box-content">
    <h2 class="auth-title">ログイン</h2>

    <form method="POST" action="/login">
      @csrf

      <label>メールアドレス</label>
      <input type="email" name="email">

      <label>パスワード</label>
      <input type="password" name="password">

      <button class="register-btn">ログインする</button>
    </form>

    <p class="login-link">
      <a href="/register">会員登録はこちら</a>
    </p>
  </div>

</div>
@endsection