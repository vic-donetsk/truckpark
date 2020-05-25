@extends('layouts.app')

@section('content')
    <div class="parks">
        <h2>Сведения об автопарках</h2>

        @include('parks.parks_button')

        <table>
            <tr>
                @foreach ($headers as $header => $value)
                    <th class="mod_{{$header}}">{{$value}}</th>
                @endforeach
                <th>Машины</th>
                <th></th>
                <th></th>
            </tr>
            @foreach ($parks as $park)
                <tr class="parks_item" data-id="{{$park->id}}">
                    @foreach ($headers as $header => $value)
                        <td class="parks_item-value mod_{{$header}}">{{ $park->{$header} }}</td>
                    @endforeach
                    <td class="parks_item-value" valign="top">
                        @foreach($park->trucks as $truck)
                            <p>{{$truck->name}}</p>
                        @endforeach
                    </td>
                    <td class="parks_item-value mod_edit">
                        <a href="{{route('park_edit', ['id' => $park->id])}}" title="Редактировать парк">
                            <svg class="svg-icon">
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

        @include('parks.parks_button')

    </div>
@endsection
