<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>FashinablyLate</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/common.css') }}" />
    @yield('css')
</head>

<body>
    <header class="header @yield('header-class')">
        <div class="header__inner">
            <a class="header__logo" href="/">
                FashinablyLate
            </a>
            @if (Request::is('login'))
            <a href="{{ route('register') }}" class="header__login-btn">register</a>
            @elseif (Auth::check())
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="header__login-btn">logout</button>
            </form>
            @else
            <a href="{{ route('login') }}" class="header__login-btn">login</a>
            @endif
        </div>
    </header>

    <main>
        @yield('content')
    </main>
    @yield('js')
</body>

</html>