<!DOCTYPE html>
<html>
<head>
  <title>COATHTECH</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<header class="header">
  <h1><a href="/">COATHTECH</a></h1>

  <div>
    @auth
      <a href="/sell" class="btn">出品</a>

      <form method="POST" action="/logout" style="display:inline;">
        @csrf
        <button class="btn">ログアウト</button>
      </form>
    @endauth

    @guest
      <a href="/login" class="btn">ログイン</a>
      <a href="/register" class="btn">登録</a>
    @endguest
  </div>
</header>

<main class="container">
  @yield('content')
</main>

</body>
</html>