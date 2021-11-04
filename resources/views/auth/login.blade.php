@push('js')
@endpush

@extends('app')

@section('title', 'Авторизация')

@section('body')
<div class="d-flex flex-column container">
    <div class="py-5 text-center p">
        <h2>Авторизация</h2>
        <label>Рады видеть вас снова 🥰</label>
    </div>
    <div class="mx-auto w-50">
        @include('app.errors')
    </div>
    <div class="mx-auto w-25">
        <form class="d-flex flex-column gap-3" method="post">
            @csrf
            <div>
                <label class="form-label">Электронная почта</label>
                <input name="email" class="form-control" required>
            </div>
            <div>
                <label class="form-label">Пароль</label>
                <input name="password" type="password" class="form-control" required>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="remember-me">
                <label class="form-check-label" for="remember-me">Запомнить меня</label>
            </div>
            <div>
                <button class="w-100 btn btn-primary">Войти</button>
                <label>Нету аккаунта? <a href="{{route('register')}}">Регистрация</a></label>
            </div>
        </form>
    </div>
</div>
@include('app.copyright')
@endsection