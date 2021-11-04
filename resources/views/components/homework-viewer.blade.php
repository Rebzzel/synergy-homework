<div {{$attributes->merge(['class' => 'list-group'])}}>
    @foreach ($d as $homework)
    <form id="hw-view.{{$homework->id}}" class="list-group-item d-flex @if($disabled) disabled @endif" method="post">
        @csrf
        <input name="id" type="hidden" value="{{$homework->id}}">
        <div class="w-50 row align-items-center">
            <div class="col-1">
                <input name="done" type="hidden" value="0">
                <input name="done" type="checkbox" value="1" @if ($homework->done) checked @endif>
            </div>
            <div class="col text-nowrap overflow-hidden">
                <label><b>Дисциплина</b></label>
               <br>
                <label>{{$homework->lesson->name}}</label>
            </div>
            <div class="col text-nowrap">
                <label><b>Срок</b></label>
                <br>
                <label>До {{$homework->expire_at->format('d.m.y')}}</label>
            </div>
        </div>
        <div class="w-75 d-flex text-nowrap overflow-hidden">
            <div class="w-75 text-nowrap overflow-hidden">
                <label><b>Задание</b></label>
                <br>
                <x-markdownless>{{$homework->description}}</x-markdownless>
            </div>
            <div class="w-25 d-flex flex-row-reverse align-items-center me-1">
                <a class="btn btn-primary" href="{{route('homework', ['id' => $homework->id])}}">Подробнее</a>
            </div>
        </div>
    </form>
    @endforeach
</div>