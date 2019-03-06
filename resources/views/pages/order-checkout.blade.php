@extends('layouts.app')

@section('content')
    <div class="mt-5">
        @if(count($errors) > 0)
            @foreach($errors->all() as $error)
                <div class="alert alert-danger">
                    {{ $error }}
                </div>
            @endforeach
        @endif
        @if(count($errors) > 0)
            @foreach($errors->all() as $error)
                <div class="alert alert-danger">
                    {{ $error }}
                </div>
            @endforeach
        @endif
        @if (session('order_id'))
            <div class="container">
                <div class="jumbotron">
                    <h1 class="display-4">Success!</h1>
                    <p class="lead">The order has been successfully created with id {{ session('order_id') }}. We have
                        also sent confirmation message on your email.</p>
                    <hr class="my-4">
                    <p>You can pay now or later.</p>
                    <a class="btn btn-primary btn-lg" href="#" role="button">Pay now</a>
                </div>
            </div>

        @endif

    </div>



@endsection