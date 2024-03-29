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
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    {{-- CSSを読み込む --}}
    {{-- <link href="{{ asset('css/member.css') }}" rel="stylesheet"> --}}
    <link href="{{ mix('css/member.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        {{-- 画面上部に表示するナビゲーションバー --}}
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ route('index') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li><a class="nav-link" href="{{ route('index') }}">トップ</a></li>
                        <li><a class="nav-link" href="{{ route('search') }}">検索</a></li>
                        <li><a class="nav-link" href="{{ route('ranking') }}">ランキング</a></li>
                        <li><a class="nav-link" href="{{ route('mypage') }}">マイページ</a></li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
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
            <footer class="mx-auto">
                <p class="text-muted">copyright © ラーメンResearch</p>
            </footer>
        </div>
    </div>
</body>
</html>