<form method="POST" action="/register">
  @csrf

  <input type="text" name="name" placeholder="ユーザー名">
  <input type="email" name="email" placeholder="メールアドレス">
  <input type="password" name="password" placeholder="パスワード">
  <input type="password" name="password_confirmation" placeholder="確認用パスワード">

  <button type="submit">登録する</button>
</form>