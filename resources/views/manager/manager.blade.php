@extends('layouts.app')

@section('content')
    <div class="parks" data-trucks="{{$trucks}}">
        <table cellpadding="5" cellspacing="0" border="2" bordercolor="#cfcfcf">
            <tr>
                <th>Название</th>
                <th>Адрес</th>
                <th>График работы</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            @foreach ($parks as $park)
            <tr class="parks_item" data-id="{{$park->id}}">
                <td class="parks_item-value">{{$park->name}}</td>
                <td class="parks_item-value">{{$park->address}}</td>
                <td class="parks_item-value">{{$park->work_schedule}}</td>
                <td class="parks_item-value mod_view">Подробности</td>
                <td class="parks_item-value mod_edit">Редактировать</td>
                <td class="parks_item-value mod_delete">Удалить</td>
            </tr>
            @endforeach
        </table>

    </div>
@endsection
