@if ($errors->any())
<div class="alert alert-danger" role="alert">
    @foreach ($errors->all() as $error)
    <label>{{ $error }}</label>
    <br>
    @endforeach
</div>
@endif