<html lang="en"><head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/starter-template.css" rel="stylesheet">
</head>
<body cz-shortcut-listen="true">
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="/">Интернет Магазин</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li @routeactive('index')><a href="{{route('index')}}">Все товары</a></li>
                <li @routeactive('categor*')><a href="{{route('categories')}}">Категории</a>
                </li>
                <li @routeactive('basket*')><a href="{{route('basket')}}">В корзину</a></li>
                <li><a href="{{route('reset_db')}}" style="pointer-events: none;">Сбросить проект в начальное состояние</a></li>
                <li><a href="http://internet-shop.tmweb.ru/locale/en">en</a></li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">₽<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="http://internet-shop.tmweb.ru/currency/RUB">₽</a></li>
                        <li><a href="http://internet-shop.tmweb.ru/currency/USD">$</a></li>
                        <li><a href="http://internet-shop.tmweb.ru/currency/EUR">€</a></li>
                    </ul>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                @guest
                <li><a href="{{route('login')}}">Войти</a></li>
                @endguest
                @auth
                          @admin
                        <li><a href="{{route('home')}}">Админ</a></li>
                        @else
                            <li><a href="{{route('person.orders.index')}}">Личный кабинет</a></li>
                        @endadmin
                <li><a href="{{route('get-logout')}}">Выйти</a></li>

                @endauth
            </ul>
        </div>
    </div>
</nav>
<div class="container">
    <div class="starter-template">
    @if(session()->has('success'))
       <p class="alert alert-success">{{session('success')}}</p>
    @endif
    @if(session()->has('warning'))
       <p class="alert alert-warning">{{session('warning')}}</p>
    @endif
    </div>
</div>
@yield('content')
</body>
</html>