@extends('layouts.master')
@section('content')
<div class="container-fluid">
    <form action="{{route('login.post')}}" method="POST"  class="mx-auto" novalidate>
        @csrf
        <h4 class="text-center">Вход</h4>
        @if($errors->any() && $retries > 0)
            <p class="mt-2 text-sm text-danger">Осталось попыток: {{ $retries }} </p>
        @endif

        @if($retries <= 0)
            <p class="mt-2 text-sm text-danger">Попробуйте заново через: <span class="text-danger">{{ $seconds }} секунд</span> </p>

        @endif
        <div class="mb-3 mt-5">
            <label for="email" class="form-label"> Email:</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" autofocus name="email">
            @error('email')
            <p class="mt-2 text-sm text-danger">{{$message}} </p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Пароль:</label>
            <input type="password"  class="form-control" id="exampleInputPassword1" name="password">
            @error('password')
            <p class="mt-2 text-sm text-danger">{{$message}} </p>
            @enderror
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="on" id="defaultCheck1" name="remember">
                <label for="remember" class="form-check-label" for="defaultCheck1">
                   Запомнить меня
                </label>
            </div>
{{--            <div id="emailHelp" class="form-text mt-3">Забыли пароль?</div>--}}
        </div>
        <button type="submit" class="btn btn-primary mt-5">Войти</button>
    </form>
</div>
 @auth
     return redirect()->route('dashboard');
 @endauth

@endsection


