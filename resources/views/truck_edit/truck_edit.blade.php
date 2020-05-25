@extends('layouts.app')

@section('content')
    <div class="truckEdit">
        <form class="truckEdit_form">
            <div class="truckEdit_header">Автомобиль</div>
            @foreach ($headers as $key => $header)
                <div class="truckEdit_item">
                    <div class="truckEdit_item-title">{{$header}}</div>
                    <div>
                        <input name="{{$key}}" type="text" class="truckEdit_item-value"
                               @if ($truck) value="{{ $truck->{$key} }}" @endif>
                        <div class="is-error"></div>
                    </div>
                </div>
            @endforeach
            <input name="id" type="hidden" @if ($truck) value="{{$truck->id}}" @endif>
            <div class="parkEdit_trucksHeader">Привязана к паркам</div>

            <div class="parksBlock">
                <div class="parksBlock_title">Название автопарка</div>
                <div class="parksBlock_delete"></div>
            </div>
            @isset($truck->parks)
                @foreach($truck->parks as $park)
                    <div class="parksBlock">
                        <div class="parksBlock_item mod_name" data-id="{{$park->id}}">{{$park->name}}</div>
                        <div class="parksBlock_delete">
                            <svg class="svg-delete">
                                <use xlink:href="#svgDelete" class="mod_delete"/>
                            </svg>
                        </div>
                    </div>

                @endforeach
            @endisset
            <div class="parksBlock mod_add">
                <div class="parksBlock_add">
                    <svg class="svg-icon">
                        <use xlink:href="#svgAdd"/>
                    </svg>
                </div>
            </div>

            <div class="parkEdit_buttons">
                <button type="submit" class="parkEdit_buttons-item mod_accept">Сохранить</button>
                <button class="parkEdit_buttons-item mod_close">
                    <a href="{{route('truck_show')}}">Отмена</a>
                </button>
            </div>
        </form>

    </div>
@endsection
