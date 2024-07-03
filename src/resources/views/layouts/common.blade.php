<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- タイトル -->
    <title>Atte</title>

    <!-- スクリプト -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- フォント -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playwrite+AU+SA:wght@100..400&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sawarabi+Mincho&display=swap" rel="stylesheet">

    <!-- スタイル -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
</head>

<body>
  <div class="app" id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white">
      <div class="container">
        <h1 class="navbar-brand" href="{{ url('/') }}">
            A<span class="titlea">t</span>te
        </h1>

          <nav>
            <div class="collapse navbar-collapse" id="navbarSupportedContent" style="justify-content: flex-end;">
              <!-- Left Side Of Navbar -->
              <ul class="navbar-nav me-auto"></ul>
              <!-- Right Side Of Navbar -->
              <ul class="navbar-nav ms-auto">
                <div class="menu">
                  <a class="dropdown-item" href="{{ route('home') }}">ホーム</a>
                  <a class="dropdown-item" href="{{ route('individual') }}">{{ Auth::user()->name }}さんの勤怠表</a>
                  <a class="dropdown-item" href="{{ route('attendance') }}">全体勤怠表</a>
                  <a class="dropdown-item" href="{{ route('user') }}">ユーザー</a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                     @csrf
                  </form>
                  <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    ログアウト
                  </a>
                </div>
              </ul>
            </div>
          </nav>

          <button id="drawer_toggle" class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="humbergermenu"></span>
            <span class="humbergertag">M<span class="spelspan">E</span>N<span class="spelspan">U</span></span>
            <span class="humbergermenu"></span>
          </button>

          <nav class="nav" id="global_nav">
          <ul>
            <li><a class="dropdown-item" href="{{ route('home') }}">ホーム</a></li>
            <li><a class="dropdown-item" href="{{ route('individual') }}">{{ Auth::user()->name }}さんの勤怠表</a></li>
            <li><a class="dropdown-item" href="{{ route('attendance') }}">全体勤怠表</a></li>
            <li><a class="dropdown-item" href="{{ route('user') }}">ユーザー</a></li>
            <li>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
              <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">ログアウト</a>
            </li>
          </ul>
        </nav>
      </div>
    </nav>

      <main class="py-4">
        @yield('common')
      </main>
    </div>

    <footer class="fotter">
       <p>Atte,inc.</p>
    </footer>

    <!-- jQuery読み込み -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        // ハンバーガーメニューの開閉処理
        $(function(){
            $(".navbar-toggler").on("click", function(){
                // メニューの開閉を切り替える
                $("#global_nav").slideToggle("open");
                $("#drawer_toggle").toggleClass("open");
            });
        });
    </script>
</body>
</html>