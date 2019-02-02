@extends('layouts.app')

@section('content')
<div class="jumbotron text-center">
    <div class="container">
        <h1>Hello, world!</h1>
        <p>This is a template for a simple marketing or informational website. It includes a large callout called a jumbotron and three supporting pieces of content. Use it as a starting point to create something more unique.</p>
        @if(!Auth::guest())
            <p><a class="btn btn-primary btn-lg" href="/dashboard" role="button"><i class="fa fa-gear"></i> Go to Dashboard</a></p>
        @else
            <p><a class="btn btn-primary btn-lg" href="/login" role="button">Login</a> <a class="btn btn-success btn-lg" href="/register" role="button">Register</a></p>
        @endif
    </div>
</div>

<h1>{{$title}}</h1>

<div id="app"></div>
@endsection