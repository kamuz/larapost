@extends('layouts.app')

@section('content')
    <a href="/posts" class="btn btn-outline-secondary"><i class="fa fa-backward"></i> Go Back</a>
    <a href="/posts/{{$post->id}}/edit" class="btn btn-secondary ml-2"><i class="fa fa-pencil"></i> Edit Post</a>
    <div class="card mt-3">
        <div class="card-body">
            <h1>{{$post->title}}</h1>
            <p><small>{{$post->created_at}}</small></p>
            <div>{{$post->body}}</div>
        </div>
    </div>
@endsection