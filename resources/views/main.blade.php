@extends('layouts.app')

@section('content')

    @can('all-parks')
        @include('nav.nav', ['route' => 'park_show', 'message' => 'Начать работу с автопарками'])
    @endcan

    @can('only-own-trucks')
        @include('nav.nav', ['route' => 'truck_show', 'message' => 'Посмотреть свои машины'])
    @endcan

@endsection
