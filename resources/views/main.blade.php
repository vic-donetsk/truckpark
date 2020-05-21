@extends('layouts.app')

@section('content')

    @can('all-parks')
        @include('manager.manager')
    @endcan

    @can('only-own-trucks')
        @include('driver.driver')
    @endcan

@endsection
