<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="/js/app.js" defer=""></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/admin.css" rel="stylesheet">
</head>
<body cz-shortcut-listen="true">
<div id="app">
    <nav class="navbar navbar-default navbar-expand-md navbar-light navbar-laravel">
        <div class="container"><a href="{{route('index')}}" class="navbar-brand">
                Вернуться на сайт
            </a>
            <div id="navbar" class="collapse navbar-collapse">
                @auth
                <ul class="nav navbar-nav">
                    @admin
                    <li><a href="{{route('categories.index')}}">Категории</a></li>
                    <li><a href="{{route('products.index')}}">Товары</a></li>

                    <li><a href="{{route('home')}}">Заказы</a></li>
                    @else
                        <li><a href="{{route('person.orders.index')}}">Заказы</a></li>
                    @endadmin
                </ul>
                @endauth
                @guest
                <ul class="nav navbar-nav navbar-right">
                    <li class="nav-item"><a href="{{route('login')}}" class="nav-link">Войти</a></li>
                    <li class="nav-item"><a href="{{route('register')}}" class="nav-link">Зарегистрироваться</a>
                    </li>
                </ul>
                    @endguest
                @auth
                    <ul class="nav navbar-nav navbar-right">
                        <li class="nav-item"><a href="{{route('logout')}}" class="nav-link">Выйти</a></li>
                    </ul>
                    @endauth
            </div>
        </div>
    </nav>
    <div class="py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">@yield('title')</div>

                        <div class="card-body">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


</body>
</html>