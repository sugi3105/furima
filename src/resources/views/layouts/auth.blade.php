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
  </header>

  <div class="auth-wrapper">
    @yield('content')
  </div>


</body>

</html>