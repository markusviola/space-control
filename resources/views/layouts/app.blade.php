<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>スペコン</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <strong class="text-primary"><i class="fas fa-rocket fa-lg mr-2 text-secondary"></i>スペコン</strong>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        <li class="nav-item ">
                            <a class="nav-link"
                                href="/"
                                data-toggle="tooltip"
                                data-placement="bottom"
                                title="ホーム"
                            ><i class="fas fa-home fa-lg"></i></a>
                        </li>
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">ログイン</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">登録</a>
                                </li>
                            @endif
                        @else
                            @if (Auth::user()->is_admin)
                                <li class="nav-item">
                                    <a
                                        class="nav-link"
                                        href="{{ route('posts.index') }}"
                                        data-toggle="tooltip"
                                        data-placement="bottom"
                                        title="スペース登録"
                                    ><i class="fas fa-map-marked-alt fa-lg"></i></a>
                                </li>
                                <li class="nav-item">
                                    <a
                                        class="nav-link"
                                        href="{{ route('forms.index') }}"
                                        data-toggle="tooltip"
                                        data-placement="bottom"
                                        title="予約管理"
                                    ><i class="fas fa-tasks fa-lg"></i></a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a
                                        class="nav-link"
                                        href="{{ route('forms.index') }}"
                                        data-toggle="tooltip"
                                        data-placement="bottom"
                                        title="提出リスト"
                                    ><i class="fas fa-list fa-lg"></i></a>
                                </li>
                            @endif
                            <li class="nav-item">
                                <a
                                    class="nav-link"
                                    href="{{ route('messenger', 0) }}"
                                    data-toggle="tooltip"
                                    data-placement="bottom"
                                    title="交渉チャット"
                                ><i class="fas fa-comments fa-lg"></i></a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle font-weight-bold" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        ログアウト
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
        @include('tools.toast')
        <main class="py-4">
            @yield('content')
        </main>
    </div>
<script type="application/javascript">
    document.addEventListener("DOMContentLoaded", (event) => {
        let checkSession = '{!! session()->has("notify") !!}';
        if (checkSession) {
            notifyUser('{{ session()->get("notify") }}');
        }
    });
</script>
</body>
</html>
