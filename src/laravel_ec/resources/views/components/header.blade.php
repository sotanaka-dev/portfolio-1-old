<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')&nbsp;/&nbsp;Hoge</title>

    {{-- NOTE: cssを上書きしないためにfontawesomeを先に読み込む --}}
    <script src="https://kit.fontawesome.com/b52cc897db.js" crossorigin="anonymous"></script>
    <script src="https://yubinbango.github.io/yubinbango/yubinbango.js" charset="UTF-8"></script>

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome-animation/0.2.1/font-awesome-animation.css"
        type="text/css" media="all" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/destyle.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    @livewireStyles
</head>

<body>
    <header class="header" id="header">
        <div class="header__inner container-lg">
            <div class="header-sidebar-wrap">
                <input class="header-sidebar-check" id="header_sidebar_check" type="checkbox">
                <label class="header-sidebar-back" for="header_sidebar_check"></label>
                @include('components.header-sidebar')
                <label class="header-sidebar-open" for="header_sidebar_check">
                    <i class="fa-solid fa-bars fa-xl"></i>
                </label>
            </div>

            <a class="header__logo link" href="{{ route('top') }}">
                {{ config('app.name') }}
            </a>

            <nav class="header__menu">
                <ul class="header__menu-list">
                    <a class="link link-line" href="{{ route('top') }}">
                        <li>Top</li>
                    </a>

                    <a class="link link-line" href="{{ route('products') }}">
                        <li>Products</li>
                    </a>

                    <a class="link link-line" href="{{ route('access') }}">
                        <li>Access</li>
                    </a>

                    @auth
                        <a class="link link-line" href="{{ route('home') }}">
                            <li>Home</li>
                        </a>
                    @else
                        <a class="link link-line" href="{{ route('login') }}">
                            <li>Login</li>
                        </a>
                    @endauth
                </ul>
            </nav>

            <div class="header__icon-wrap">
                <a class="header__icon" href='{{ route('fav-list') }}'>
                    @livewire('fav.qty-in-item-list')
                    <i class="fa-solid fa-heart fa-xl"></i>
                </a>

                <a class="header__icon" href='{{ route('cart') }}'>
                    @livewire('qty-in-cart')
                    <i class="fa-solid fa-cart-shopping fa-xl"></i>
                </a>
            </div>
        </div>
    </header>
