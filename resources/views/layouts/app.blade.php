<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name', 'Laravel APP') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

@include('include.navbar')

<div class="container">
@include('include.messages')
@yield('content')
</div>

<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <hr>
                <p class="pull-left">2018 © All right reserved</p>
                <p class="pull-right">Developed by <a href="https://github.com/kamuz">Volodymyr Kamuz</a></p>
            </div>
        </div>
    </div>
</footer>

<script src="{{asset('js/app.js')}}"></script>
</body>
</html>