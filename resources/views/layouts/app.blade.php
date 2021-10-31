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

<script src="{{asset('js/app.js')}}"></script>
</body>
</html>