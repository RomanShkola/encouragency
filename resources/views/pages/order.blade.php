@extends('layouts.app')


@section('content')
    <order-component :data="{{json_encode($data)}}"></order-component>
@endsection