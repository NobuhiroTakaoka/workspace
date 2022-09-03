<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- 各ページごとにtitleタグを入れるために@yieldで空ける --}}
    <title>@yield('title')</title>

    <!-- Scripts -->
    {{-- Laravel標準で用意されているJavascriptを読み込む --}}
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
    <script src="{{ mix('js/app.js') }}" defer></script>
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    {{-- Laravel標準で用意されているCSSを読み込む --}}
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    {{-- <link href="{{ mix('css/bootstrap-reboot.css') }}" rel="stylesheet"> --}}
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    {{-- CSSを読み込む --}}
    {{-- <link href="{{ asset('css/front.css') }}" rel="stylesheet"> --}}
    <link href="{{ mix('css/front.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        {{-- 画面上部に表示するナビゲーションバー --}}
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li><a class="nav-link" href="{{ url('/') }}">トップ</a></li>
                        <li><a class="nav-link" href="{{ route('search') }}">検索</a></li>
                        <li><a class="nav-link" href="{{ route('ranking') }}">ランキング</a></li>
                        {{-- ログインしていなかったらログイン画面へのリンクタブを表示 --}}
                        @guest
                            <li><a class="nav-link" href="{{ route('login') }}">ログイン</a></li>
                        {{-- ログインしていたらマイページ画面へのリンクタブを表示 --}}
                        @else
                            <li><a class="nav-link" href="{{ route('mypage') }}" method="GET">マイページ</a></li>
                        @endguest
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        {{-- ログインしていなかったらログイン画面へのリンクを表示 --}}
                        @guest
                            <li><a class="nav-link" href="{{ route('login') }}">{{ __('messages.Login') }}</a></li>
                        {{-- ログインしていたらユーザー名とログアウトボタンを表示 --}}
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('messages.Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        {{-- ここまでナビゲーションバー --}}

        <main class="py-4">
            {{-- コンテンツをここに入れるため、@yieldで空けておく。 --}}
            @yield('content')
        </main>
        
        {{-- フッター --}}
        <div class="row">
            <footer class="footer-contents mx-auto">
                <div class="text-center">
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

                    <span class="text-muted">シェアする</span><br />
                    <div class="shares row mx-auto">
                        <!-- Facebook -->
                        <a class="js-sns-link m-2" href="//www.facebook.com/sharer/sharer.php?u=&t=" target="_blank" rel="nofollow noopener noreferrer">
                            <span>facebook</span><br />
                            <img class="m-1" src="{{ asset('storage/' . 'facebook_share_logo.png') }}">
                        </a>
                        <!-- Twitter -->
                        <a class="js-sns-link m-2" href="//twitter.com/intent/tweet?text=&url=" target="_blank" rel="nofollow noopener noreferrer">
                            <span>twitter</span><br />
                            <img class="m-1" src="{{ asset('storage/' . 'Twitter_share_logo.png') }}">
                        </a>
                    </div>

                    <script>
                        let url = location.href
                        let snsLinks = $(".js-sns-link")
                        for (let i = 0; i < snsLinks.length; i++) {
                            let href = snsLinks.eq(i).attr('href');
                            // シェアページのURL上書き
                            href = href.replace("u=","u="+url)      // facebook
                            href = href.replace("url=","url="+url)  // twitter,LINE,はてなブログ,ピンタレスト
                            snsLinks.eq(i).attr('href',href);
                        }
                    </script>
                </div>
                
                <p class="text-muted">copyright © ラーメンResearch</p>
            </footer>
        </div>
    </div>
</body>
</html>