@push('js')
<script>

$('#save_button').on('click', () => {
    const indicator = $('#save_indicator');
    const status = $('#status');
    const aboutMe = $('#about_me');

    $.ajax({
        type: 'post',
        data: {
            'status': status.val(),
            'about_me': aboutMe.val(),
        },
        headers: {
            'X-CSRF-Token': '{{csrf_token()}}'
        },
        success: data => {
            indicator.fadeTo(500, 1.0, () => indicator.fadeTo(1000, 0.0));
        }
    });
});

$('#upload_button').on('click', () => $('#file_dialog').click());
$('#file_dialog').on('change', event => {
    const data = new FormData();
    data.append('file', event.target.files[0]);
    $.ajax({
        url: '{{route("uploader")}}',
        type: 'post',
        cache: false,
        contentType: false,
        processData: false,
        data: data,
        headers: {
            'X-CSRF-Token': '{{csrf_token()}}'
        },
        success: data => {
            const form = event.target.form;
            const url = $(form).find('[name="avatar_url"]')[0];
            url.value = data.response[0];
            form.submit();
        }
    });
});

</script>
@endpush

<h3>Учетная запись</h3>
<hr>
@include('app.errors')
<div class="row">
    <div class="col">
        <div>
            <label class="form-label">Статус</label>
            <input id="status" class="form-control" value="{{$user->status}}"></input>
        </div>
        <div class="mt-2">
            <label class="form-label">О себе</label>
            <textarea id="about_me" class="form-control" value="">{{$user->about_me}}</textarea>
        </div>
        <hr>
        <div>
            <button id="save_button" class="btn btn-primary">Сохранить</button>
            <label id="save_indicator" class="ps-2" style="opacity: 0;">Изменения сохранены</label>
        </div>
    </div>
    <div class="col-3 pb-2">
        <form method="post">
            @csrf
            <input id="file_dialog" type="file" hidden>
            <input name="avatar_url" type="hidden">
            <label class="form-label">Аватар</label>
            <br>
            <img class="img-thumbnail p-0" @if ($user->avatar_url) src="{{Storage::url($user->avatar_url)}}" @endif  style="width:200px;height:200px">
            <button id="upload_button" type="button" class="btn btn-primary mt-2" style="width:200px">Изменить</button>
        </form>
    </div>
</div>