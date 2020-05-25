@extends('layouts.app')

@section('content')
    <div class="trucks">
        <h2>Сведения об автомобилях</h2>

        @include('trucks.trucks_button')
        
        <table>
            <tr>
                @foreach ($headers as $header)
                    <th>{{$header}}</th>
                @endforeach
                <th>Числится в парках</th>
                <th></th>
            </tr>
            @foreach ($trucks as $truck)
                <tr class="trucks_item" data-id="{{$truck->id}}">
                    <td class="trucks_item-value">{{$truck->name}}</td>
                    <td class="trucks_item-value">{{$truck->driver}}</td>
                    <td class="trucks_item-value" valign="top">
                        @foreach($truck->parks as $park)
                            <p>{{$park->name}}</p>
                        @endforeach
                    </td>
                    @if (\Illuminate\Support\Facades\Route::currentRouteName() === 'truck_show')
                        <td class="trucks_item-value mod_edit">
                            <a href="{{route('truck_edit', ['id' => $truck->id])}}" title="Редактировать данные">
                                <svg class="svg-icon">
                                    <use xlink:href="#svgEdit"/>
                                </svg>
                            </a>
                        </td>
                    @else
                        <td class="trucks_item-value mod_delete" title="Удалить машину">
                            <svg class="svg-icon">
                                <use xlink:href="#svgDelete"/>
                            </svg>
                        </td>
                    @endif
                </tr>
            @endforeach
        </table>

        @include('trucks.trucks_button')

    </div>
@endsection
