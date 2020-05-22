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
                <tr class="parks_item">
                    <td class="parks_item-value">{{$park->name}}</td>
                    <td class="parks_item-value">{{$park->address}}</td>
                    <td class="parks_item-value">{{$park->work_schedule}}</td>
                    <td class="parks_item-value" valign="top">
                        @foreach($park->trucks as $truck)
                            <p>{{$truck->name}}</p>
                        @endforeach
                    </td>
                    <td class="parks_item-value mod_edit"><a href="{{route('park_edit', ['id' => $park->id])}}">Редактировать</a></td>
                    <td class="parks_item-value mod_delete">Удалить</td>
                </tr>
            @endforeach
        </table>


    </div>
@endsection
