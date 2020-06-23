<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8"'>
    <link rel='stylesheet' href='/css/app.css'>
    <link rel='stylesheet' href="{{ asset('/css/header-style.css') }}">
    <link rel='stylesheet' href="{{ asset('/css/footer-style.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
  <div class="container">
    <!-- ヘッダー -->
    <header>
      <!-- ロゴ -->
      <div class="header-logo">
        <h1>Twitter</h1>
      </div> <!-- /header-logo -->
      <!-- リスト -->
      <div class="header-list">
        <ul>
          <li><a href="#">ホーム</a></li>
          <li><a href="#">友達検索</a></li>
          <li><a href="#">ログアウト</a></li>
        </ul>
      </div> <!-- /header-list -->
    </header>
  </div> <!-- /container -->

  @yield('content')

  <!-- フッター -->
  <div class="container">
    <footer>
      <p>Laravel@dawn.curriculum</p>
    </footer>
  </div> <!-- /container -->

  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</body>

</html>
