@extends('layouts.app')

@section('content')
    <div class="parkEdit">
        <form class="parkEdit_form">
            <div class="parkEdit_header">Автопарк</div>
            @foreach ($headers as $key => $header)
                <div class="parkEdit_item">
                    <div class="parkEdit_item-title">{{$header}}</div>
                    <div>
                        <input name="{{$key}}" type="text" class="parkEdit_item-value"
                               @if ($park) value="{{ $park->{$key} }}" @endif>
                        <div class="is-error"></div>
                    </div>
                </div>
            @endforeach
            <input name="id" type="hidden" @if ($park) value="{{$park->id}}" @endif>
            <div class="parkEdit_trucksHeader">Машины</div>

            <div class="trucksBlock">
                <div class="trucksBlock_title">Номер машины</div>
                <div class="trucksBlock_title">Имя водителя</div>
                <div class="trucksBlock_delete"></div>
            </div>
            @isset($park->trucks)
                @foreach($park->trucks as $truck)
                    <div class="trucksBlock">
                        <div class="trucksBlock_item mod_name" data-id="{{$truck->id}}">{{$truck->name}}</div>
                        <div class="trucksBlock_item mod_driver">{{$truck->driver}}</div>
                        <div class="trucksBlock_delete">
                            <svg class="svg-delete">
                                <use xlink:href="#svgDelete" class="mod_delete"/>
                            </svg>
                        </div>
                    </div>
                @endforeach
            @endisset
            <div class="trucksBlock mod_add">
                <div class="trucksBlock_add">
                    <svg class="svg-icon">
                        <use xlink:href="#svgAdd"/>
                    </svg>
                </div>
            </div>

            <div class="parkEdit_buttons">
                <button type="submit" class="parkEdit_buttons-item mod_accept">Сохранить</button>
                <button class="parkEdit_buttons-item mod_close">
                    <a href="{{route('park_show')}}">Отмена</a>
                </button>
            </div>
        </form>

    </div>
@endsection
