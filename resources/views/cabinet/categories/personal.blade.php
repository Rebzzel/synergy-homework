@push('js')
<script>

$('input[name="snils_id"]').mask('000-000-000 00');

</script>
@endpush

<h3>Личные документы</h3>   
<hr>
@include('app.errors')
<div class="row">
    <div class="col list-group">
        <label class="list-group-item title">Почта</label>
        <div class="list-group-item d-grid gap-2">
            <div>
                <label>Адрес</label>
                <br>    
                <h5>{{$user->email}}</h5>
            </div>
        </div>
    </div>
    <div class="col list-group">
        <label class="list-group-item title">Паспорт</label>
        <div class="list-group-item d-grid gap-2">
            <div>
                <label>Дата рождения</label>
                <br>    
                <h5>{{$user->birthday_at->format('d.m.Y')}}</h5>
            </div>
            <div>
                <label>Номер:</label>
                <br>    
                <h5>{{$user->passport_id}}</h5>
            </div>
            <div>
                <label>Выдан:</label>
                <br>    
                <h5>{{$user->passport_given_by}}</h5>
            </div>
        </div>
    </div>
    <div class="col list-group">
        <label class="list-group-item title">Снилс</label>
        <div class="list-group-item d-grid gap-2">
            @if ($user->snils_id == null)
            <form class="d-grid gap-2" method="post">
                @csrf
                <div>
                    <label>Номер:</label>
                    <br>
                    <input name="snils_id" class="form-control">
                </div>
                <button id="save_snils" class="w-100 btn btn-primary">Сохранить</button>
            </form>
            @else
            <div>
                <label>Номер:</label>
                <br>    
                <h5>{{$user->snils_id}}</h5>
            </div>
            @endif
        </div>
    </div>
</div>