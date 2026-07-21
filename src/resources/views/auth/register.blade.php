@extends('layouts.auth')

@section('content')
<div class="auth-box">


  <div class="box-content">
    <h2 class="auth-title">会員登録</h2>

    <form method="POST" action="/register" novalidate>
      @csrf

      <label>ユーザー名</label>
      <input type="text" name="name" value="{{ old('name') }}">
      @error('name')
      <div class="error">{{ $message }}</div>
      @enderror

      <label>メールアドレス</label>
      <input type="email" name="email" value="{{ old('email') }}">
      @error('email')
      <div class="error">{{ $message }}</div>
      @enderror

      <label>パスワード</label>
      <input type="password" name="password">
      @error('password')
      <div class="error">{{ $message }}</div>
      @enderror

      <label>確認用パスワード</label>
      <input type="password" name="password_confirmation">
      @error('password_confirmation')
      <div class="error">{{ $message }}</div>
      @enderror
      <button class="register-btn">登録する</button>
    </form>

    <p class="login-link">
      <a href="/login">ログインはこちら</a>
    </p>
  </div>
</div>

</div>
@endsection