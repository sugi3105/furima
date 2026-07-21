<!DOCTYPE html>
<html>

<head>
  <title>COATHTECH</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

  <header class="header">
    <a href="/">
      <img src="{{ asset('images/logo.png') }}" alt="logo">
    </a>
    <form action="{{ request()->is('mylist') ? 'mylist' : '/' }}" method="GET" class="search-form">

      @if(request('tab') === 'mylist')
      <input type="hidden" name="tab" value="mylist">
      @endif
      <input type="text"
        name="keyword"
        placeholder="なにをお探しですか?"
        value="{{ request('keyword') }}">
    </form>

    <div class="header-nav">
      @auth
      <form method="POST" action="/logout" style="display:inline;">
        @csrf
        <button class="btn logout-btn">ログアウト</button>
      </form>
      <a href="/mypage" class="btn">マイページ</a>
      <a href="/sell" class="header-sell-btn">出品</a>

      @endauth

      @guest
      <a href="/login" class="btn">ログイン</a>
      <a href="/mypage" class="btn">マイページ</a>
      <a href="/sell" class="header-sell-btn">出品</a>
      @endguest
    </div>
  </header>
  <main>
    @yield('content')
  </main>
</body>

</html>