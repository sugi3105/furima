@extends('layouts.auth')

@section('content')
<div class="auth-box">

  
  <div class="box-content">
    <h2 class="auth-title">ログイン</h2>

    <form method="POST" action="/login">
      @csrf

      <label>メールアドレス</label>
      <input type="email" name="email">
      @error('email')
       <div class="error">{{ $message }}</div>
      @enderror

      <label>パスワード</label>
      <input type="password" name="password">
      @error('password')
       <div class="error">{{ $message }}</div>
      @enderror


      <button class="register-btn">ログインする</button>
    </form>

    <p class="login-link">
      <a href="/register">会員登録はこちら</a>
    </p>
  </div>

</div>
@endsection