@extends('layouts.app')

@section('content')
    <div class="parks">
        <h2>Сведения об автопарках</h2>
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
                <tr class="parks_item" data-id="{{$park->id}}">
                    <td class="parks_item-value">{{$park->name}}</td>
                    <td class="parks_item-value">{{$park->address}}</td>
                    <td class="parks_item-value">{{$park->work_schedule}}</td>
                    <td class="parks_item-value" valign="top">
                        @foreach($park->trucks as $truck)
                            <p>{{$truck->name}}</p>
                        @endforeach
                    </td>
                    <td class="parks_item-value mod_edit">
                        <a href="{{route('park_edit', ['id' => $park->id])}}" title="Редактировать парк">
                            <svg class="svg-icon" >
                                <use xlink:href="#svgEdit"/>
                            </svg>
                        </a>
                    </td>
                    <td class="parks_item-value mod_delete" title="Удалить парк">
                        <svg class="svg-icon">
                            <use xlink:href="#svgDelete"/>
                        </svg>
                    </td>
                </tr>
            @endforeach
        </table>
        <a href="{{route('park_edit')}}" class="parks_add" title="Создать новый автопарк">
            <svg class="svg-icon">
                <use xlink:href="#svgAdd"/>
            </svg>
        </a>


    </div>
@endsection
