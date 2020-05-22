<div class="parkEdit">
    <form action="{{route('park_update')}}" method="POST" class="parkEdit_form">
        @csrf
        <div class="parkEdit_title">Автопарк</div>
        @foreach ($headers as $key => $header)
            <div class="parkEdit_item">
                <div class="parkEdit_item-title">{{$header}}</div>
                <input name="{{$key}}" type="text" class="parkEdit_item-value @error($key) is-invalid @enderror"
                       @if ($park) value="{{ $park->{$key} }}" @endif>
                @error($key)
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        @endforeach
        <input name="id" type="hidden" @if ($park) value="{{$park->id}}" @endif>
        <div class="parkEdit_buttons">
            <button type="submit" class="parkEdit_buttons-item mod_accept">Сохранить</button>
            <a href="{{route('park_show')}}" class="parkEdit_buttons-item mod_close">Отмена</a>
        </div>
    </form>

</div>
