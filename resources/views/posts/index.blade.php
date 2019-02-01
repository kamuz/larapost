@extends('layouts.app')

@section('content')
    <h1 class="pull-left">Posts</h1>
    <a href="/posts/create" class="btn btn-success mb-4 pull-right"><i class="fa fa-pencil"></i> New Post</a>
    <div class="clearfix"></div>
    @if(count($posts) > 0)
        @foreach($posts as $post)
            <div class="card mb-3">
                <div class="card-body">
                    <h3><a href="posts/{{$post->id}}">{{$post->title}}</a></h3>
                    <small>Written on {{ $post->created_at }} by {{ $post->user->name }}</small>
                </div>
            </div>
        @endforeach
        {{ $posts->links() }}
    @else
        <p>Posts not found</p>
    @endif
@endsection