@extends('layouts.app')

@section('content')
    <div class="parks">
        <h2>Сведения об автомобилях</h2>
        <table>
            <tr>
                @foreach ($headers as $header)
                    <th>{{$header}}</th>
                @endforeach
                <th>Числится в парках</th>
                <th></th>
            </tr>
            @foreach ($trucks as $truck)
                <tr class="parks_item" data-id="{{$truck->id}}">
                    <td class="parks_item-value">{{$truck->name}}</td>
                    <td class="parks_item-value">{{$truck->driver}}</td>
                    <td class="parks_item-value" valign="top">
                        @foreach($truck->parks as $park)
                            <p>{{$park->name}}</p>
                        @endforeach
                    </td>
                    <td class="parks_item-value mod_edit">
                        <a href="{{route('truck_edit', ['id' => $truck->id])}}" title="Редактировать данные">
                            <svg class="svg-icon" >
                                <use xlink:href="#svgEdit"/>
                            </svg>
                        </a>
                    </td>
                </tr>
            @endforeach
        </table>
        <a href="{{route('truck_edit')}}" class="parks_add" title="Добавить новый автомобиль">
            <svg class="svg-icon">
                <use xlink:href="#svgAdd"/>
            </svg>
        </a>


    </div>
@endsection
