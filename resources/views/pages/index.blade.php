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

<p>Lorem, ipsum dolor sit amet, consectetur adipisicing elit. Repellat, laboriosam, nihil. Quibusdam, hic, animi. Officia earum reiciendis natus ipsam vel, animi nostrum obcaecati quam accusamus numquam! Aut commodi vel minus.</p>
<p>Facilis consequatur neque quos, eum. Incidunt deleniti temporibus dolorem perspiciatis dolore voluptas fuga quas ipsum, impedit doloremque, illum, molestias laborum animi aliquid dignissimos nobis. Accusamus, eligendi, quos. Sunt, facilis, quaerat!</p>

@endsection