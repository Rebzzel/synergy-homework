@push('js')
<script>

$('#nav-menu a#{{$category}}').addClass('active');

</script>
@endpush

@php
$now = Carbon\Carbon::now();
$hw_active = $user->homework->where('expire_at', '>', $now) ?? collect();
$hw_undone = $hw_active->where('done', false) ?? collect();
@endphp

@extends('app')

@section('title', 'Личный кабинет')
@section('body')

<main class="mx-auto container-lg row mt-5">
    <div id="nav-menu" class="col-3">   
        <nav class="list-group mb-2">
            <div class="list-group-item title d-flex align-items-center">
                <img @if ($user->avatar_url) src="{{Storage::url($user->avatar_url)}}" @endif class="img-thumbnail p-0 rounded-circle" style="width:32px;height:32px;min-width:32px">
                <div class="ps-2 p-0 gap-0">
                    <label>{{ $user->full_name }}</label>
                    <small>Программирование / 1 курс</small>
                </div>
            </div>
            <a id="schedule" class="list-group-item" href="{{route('schedule')}}">Расписание</a>
            <a id="homework" class="list-group-item" href="{{route('homework')}}">
                Домашняя работа
                @if ($hw_undone->count() > 0)
                <span class="badge bg-warning">{{$hw_undone->count()}}</span>
                @endif
            </a>
        </nav>  
        <nav class="list-group mb-2">
            <a id="account" class="list-group-item" href="{{route('account')}}">Учетная запись</a>
            <a id="personal" class="list-group-item" href="{{route('personal')}}">Личные документы</a>
            <a id="security" class="list-group-item" href="{{route('security')}}">Безопасность</a>
        </nav>
        <nav class="list-group">
            <a class="list-group-item" href="{{route('logout')}}">Выйти</a>
        </nav>
    </div>
    <div class="col overflow-hidden">
        @include('cabinet.categories.'.$category)
    </div>
</main>

@include('app.copyright')
@endsection