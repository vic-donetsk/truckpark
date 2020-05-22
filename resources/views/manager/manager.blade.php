@extends('layouts.app')

@section('content')
    <div class="parks">
        <table>
            <tr>
                @foreach ($headers as $header)
                    <th>{{$header}}</th>
                @endforeach
                <th>Машины</th>
                <th></th>
                <th></th>
            </tr>
            @foreach ($parks as $park)
                <tr class="parks_item" data-park="{{$park}}">
                    <td class="parks_item-value">{{$park->name}}</td>
                    <td class="parks_item-value">{{$park->address}}</td>
                    <td class="parks_item-value">{{$park->work_schedule}}</td>
                    <td class="parks_item-value" valign="top">
                        @foreach($park->trucks as $truck)
                            <p>{{$truck->name}}</p>
                        @endforeach
                    </td>
                    <td class="parks_item-value mod_edit">Редактировать</td>
                    <td class="parks_item-value mod_delete">Удалить</td>
                </tr>
            @endforeach
        </table>

        <div class="parks_modal">
            <form action="{{route('park_update')}}" method="POST" class="parkEdit">
                @csrf
                <div class="parkEdit_title">Автопарк</div>
                @foreach ($headers as $key => $header)
                    <div class="parkEdit_item">
                        <div class="parkEdit_item-title">{{$header}}</div>
                        <input name="{{$key}}" type="text" id="parkEdit_{{$key}}"
                               class="parkEdit_item-value @error($key) is-invalid @enderror">
                        @error($key)
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                @endforeach
                <input name="id" type="hidden" id="parkEdit_id">
                <div class="parkEdit_buttons">
                    <button type="submit" class="parkEdit_buttons-item mod_accept">Сохранить</button>
                    <div class="parkEdit_buttons-item mod_close">Отмена</div>
                </div>
            </form>

        </div>

    </div>
@endsection
