@if (!isset($homework))

<h3>Домашняя работа 🥰</h3>
@include('app.errors')
<hr>

@php
$now = Carbon\Carbon::now();

$hw_active  = $user->homework->where('expire_at', '>', $now) ?? collect();
$hw_expired = $user->homework->where('expire_at', '<=', $now) ?? collect();
$hw_done    = $hw_active->where('done', true) ?? collect();
$hw_undone  = $hw_active->where('done', false) ?? collect();
@endphp

<div class="d-flex flex-row justify-content-between mb-3">
    <div>
    </div>
    <div>
    </div>
    <div>
        <label id="save_indicator" class="pe-2" hidden></label>
        <button id="save_button" class="btn btn-primary">Сохранить</button>
    </div>
</div>
<div class="mb-2">
    <h5>Ожидают выполнения ({{$hw_undone->count()}})</h5>
    <x-homework-viewer :d="$hw_undone"/>
</div>
<div class="mb-2">
    <h5>Выполнены ({{$hw_done->count()}})</h5>
    <x-homework-viewer :d="$hw_done"/>
</div>
<div>
    <h5>Старые ({{$hw_expired->count()}})</h5>
    <x-homework-viewer :d="$hw_expired" :disabled="true"/>
</div>
@push('js')
<script>

let saveLocked = false;

$('#save_button').on('click', event => {
    if (saveLocked) return;

    const forms = $('form[id^="hw-view."]:not([class~="disabled"])');
    const indicator = $('#save_indicator');

    if (forms.length < 1) return;

    saveLocked = true;
    let done = 0;
    let changed = false;

    indicator.removeAttr('hidden');

    const updateIndicator = () => {
        indicator.text(`${done}/${forms.length}`);
    };

    updateIndicator();

    forms.each((i, el) => {
        $.ajax({
            method: 'post',
            data: $(el).serialize()
        }).done(data => {
            if (data.status == 200) {
                changed = true;
            }
        }).always(() => {
            const isdone = ++done == forms.length;
            updateIndicator();
            if (isdone) {
                if (changed) {
                    location.reload();
                } else {
                    indicator.attr('hidden', '');
                    saveLocked = false;
                }
            }
        });
    });
});

</script>
@endpush

@if (config('app.debug'))

@php
$users = \App\Models\User::all();
$lessons = \App\Models\Lesson::all();
@endphp

<div class="debug d-grid gap-3">
    <div class="list-group">
        <div class="list-group-item title">[DEBUG] Новая дисциплина</div>
        <form class="list-group-item d-grid gap-3" action="{{route('debug', ['action'=>'add.lesson'])}}" method="post">
            @csrf
            <div>
                <label>Название</label>
                <input name="name" class="form-control">
            </div>
            <div class="d-flex justify-content-center">
                <button class="btn btn-primary">Добавить</button>
            </div>
        </form>
    </div>
    <div class="list-group">
        <div class="list-group-item title">[DEBUG] Новое домашнее задание</div>
        <form class="list-group-item d-grid gap-3" action="{{route('debug', ['action'=>'add.homework'])}}" method="post">
            @csrf
            <div>
                <label>ID пользователя</label>
                <select name="user_id" class="form-select">
                    @foreach ($users as $u)
                    <option value="{{$u->id}}" @if ($user->id == $u->id) selected @endif>{{$u->id}}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label>Дисциплина</label>
                <select name="lesson_id" class="form-select">
                    @foreach ($lessons as $lesson)
                    <option value="{{$lesson->id}}">{{$lesson->name}}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label>Срок</label>
                <input name="expire_at" type="date" class="form-control">
            </div>
            <div>
                <label>Задание (markdown)</label>
                <textarea name="description" class="form-control"></textarea>
            </div>
            <div class="d-flex justify-content-center">
                <button class="btn btn-primary">Добавить</button>
            </div>
        </form>
    </div>
</div>

@endif

@else

<div class="d-flex justify-content-between">
    <h3>{{$homework->lesson->name}}</h3>
    <a class="m-1 btn btn-primary" href="{{route('homework')}}">Назад</a>
</div>

@include('app.errors')
<hr>
<x-markdown>{{$homework->description}}</x-markdown>

@if (config('app.debug'))
<div class="debug">
    <div class="d-flex">
        <form method="post" action="{{route('debug', ['action'=>'delete.homework'])}}">
            @csrf
            <input name="id" type="hidden" value="{{$homework->id}}">
            <button class="btn btn-primary">Удалить</button>
        </form>
    </div>
</div>
@endif

@endif