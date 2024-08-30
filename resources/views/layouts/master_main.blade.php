<!doctype html>
<html lang="ru" xmlns="http://www.w3.org/1999/html">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <script src="{{asset('js/jquery-3.7.1.min.js')}}"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="{{ asset('css/mainstyle.css') }}" rel="stylesheet" >
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <title>Склад</title>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{route('dashboard')}}">Склад</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('sclad_of_dries')}}">Сухой Пиломатериал</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('sclad_of_raws')}}">Сырой пиломатериал</a>
                </li>
                <li class="nav-item">
                    @can('role',auth()->user())
                        <a class="nav-link" href="{{route('supplies.index')}}">Поставки</a>
                    @endcan
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('orders.index')}}">Заказы</a>
                </li>
                <li class="nav-item">
                    @can('role',auth()->user())
                        <a class="nav-link" href="{{route('dryer.index')}}">Сушилки</a>
                    @endcan
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('calendar')}}">Календарь заказов</a>
                </li>
                <li class="nav-item">
                    @can('admin',auth()->user())
                    <a class="nav-link" href="{{route('revision.index')}}">Ревизия</a>
                    @endcan
                </li>
                <li class="nav-item">
                    @can('admin',auth()->user())
                    <a class="nav-link" href="{{route('admin_panel.index')}}">Админка</a>
                    @endcan
                </li>
            </ul>
            <form class="d-flex" action="{{route('logout')}}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary">Выйти из аккаунта</button>
            </form>
        </div>
    </div>
</nav>
<div class="py-4">
    <div class="container">
        <div class="row justify-content-center">
            @yield('content')
        </div>
    </div>
</div>
</div>



<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
@yield('script')
</body>
</html>
