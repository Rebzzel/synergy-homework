@extends('app')

@push('js')
<script>

$('input[name="email"]').on('input', e => {
    e.target.value = e.target.value.replace(/[!#$%\^&]/g, '');
});

$('input[name*="name"]').on('input', e => {
    e.target.value = e.target.value.replace(/\d|[ !#$%\^&]/g, '');
});

$('input[name="passport_order"]').mask('00000');
$('input[name="passport_id"]').mask('000000');

$('form').submit(e => {
    const order = $('#passport_order').val();
    const id = $('#passport_id').val();
    const passport_id = order + ' ' + id;

    $('<input/>')
        .attr('type', 'hidden')
        .attr('name', 'passport_id')
        .attr('value', passport_id)
        .appendTo(e.target);
});

</script>
@endpush

@section('title', 'Регистрация')

@section('body')
<div class="d-flex flex-column container">
    <div class="py-5 text-center p">
        <h2>Регистрация</h2>
        <label>Это не займет много времени 😉</label>
    </div>
    <div class="mx-auto w-50">
        @include('app.errors')
    </div>
    <div class="mx-auto w-25">
        <form class="d-flex flex-column gap-3" method="post">
            @csrf
            <h4>Данные для входа:</h4>
            <div>
                <label class="form-label">Электронная почта</label>
                <input name="email" type="text" class="form-control" required>
            </div>
            <div>
                <label class="form-label">Пароль</label>
                <input name="password" type="password" class="form-control" required>
            </div>
            <div>
                <label class="form-label">Пароль (повтор)</label>
                <input name="password_confirmation" type="password" class="form-control" required>
            </div>
            <hr>
            <h4>Паспортные данные:</h4>
            <div>
                <label class="form-label">Фамилия</label>
                <input name="last_name" type="text" class="form-control" required>
            </div>
            <div>
                <label class="form-label">Имя</label>
                <input name="first_name" type="text" class="form-control" required>
            </div>
            <div>
                <label class="form-label">Отчество</label>
                <input name="middle_name" type="text" class="form-control" required>
            </div>
            <div>
                <label class="form-label">Дата рождения</label>
                <input name="birthday_at" type="date" class="form-control" required>
            </div>
            <div class="row">
                <div class="col-sm-6">  
                    <label class="form-label">Серия</label>
                    <input id="passport_order" type="text" class="form-control" required>
                </div>
                <div class="col-sm-6">
                    <label class="form-label">Номер</label>
                    <input id="passport_id" type="text" class="form-control" required>
                </div>
            </div>
            <div>
                <label class="form-label">Кем выдан</label>
                <input name="passport_given_by" type="text" class="form-control" required>
            </div>
            <div>
                <button class="w-100 btn btn-primary">Зарегистрироваться</button>
                <label>Уже имеете аккаунт? <a href="{{route('login')}}">Войти</a></label>
            </div>
        </form>
    </div>
</div>

@include('app.copyright')
@endsection