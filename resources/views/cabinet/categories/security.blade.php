<h3>Безопасность</h3>
<hr>
@include('app.errors')
@include('app.status')
<div class="row">
    <form class="col list-group" method="post">
        <div class="list-group-item title">
            @csrf
            <label>Смена почты</label>
        </div>
        <div class="list-group-item d-grid gap-2" method="post">
            <div>
                <label>Новая почта</label>
                <br>    
                <input name="email" class="form-control"></input>
            </div>
        </div>
        <div class="list-group-item">
            <button class="w-100 btn btn-primary">Обновить</button>
        </div>
    </form>
    <form class="col list-group" method="post">
        <div class="list-group-item title">
            @csrf
            <label>Смена пароля</label>
        </div>
        <div class="list-group-item d-grid gap-2" method="post">
            <div>
                <label>Введите старый пароль:</label>
                <br>    
                <input name="old_password" class="form-control" type="password"></input>
            </div>
            <div>
                <label>Введите новый пароль:</label>
                <br>    
                <input name="new_password" class="form-control" type="password"></input>
            </div>
            <div>
                <label>Повторите новый пароль:</label>
                <br>    
                <input name="new_password_confirmation" class="form-control" type="password"></input>
            </div>
        </div>
        <div class="list-group-item">
            <button class="w-100 btn btn-primary">Обновить</button>
        </div>
    </form>
    <div class="col"></div>
</div>