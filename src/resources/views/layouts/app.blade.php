<!DOCTYPE html>
<html>
<head>
  <title>COATHTECH</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<header class="header">
  <h1><a href="/">COACHTECH</a></h1>
     <form action="/" method="GET" class="searth-form">
      <input type="text"
             name="keyword"
             placeholder="なにをお探しですか?"
             value="{{ request('keyword') }}">
     </form>
     
  <div class="header-nav">
    @auth
      <a href="/mypage" class="btn">マイページ</a>
      <a href="/sell" class="btn">出品</a>

      <form method="POST" action="/logout" style="display:inline;">
        @csrf
        <button class="btn logout-btn">ログアウト</button>
      </form>
    @endauth

    @guest
      <a href="/login" class="btn">ログイン</a>
      <a href="/register" class="btn">登録</a>
    @endguest
  </div>
</header>
  <main>
      @yield('content')
  </main>
</body>
</html>