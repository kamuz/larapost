@extends('layouts.app')

@section('content')
    <h1 class="pull-left">Posts</h1>
    <a href="/posts/create" class="btn btn-success mb-4 pull-right"><i class="fa fa-pencil"></i> New Post</a>
    <div class="clearfix"></div>
    @if(count($posts) > 0)
        @foreach($posts as $post)
            @if($post->image)
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="/public/storage/images/{{ $post->image }}" alt="{{ $post->title }}" class="img-thumbnail img-fluid">
                        </div>
                        <div class="col-md-8">
                            <h3><a href="posts/{{ $post->id}}">{{ $post->title }}</a></h3>
                            <small>Written on {{ $post->created_at }} by {{ $post->user->name }}</small>
                        </div>
                    </div>
                </div>
            </div>
            @else
                <div class="card mb-3">
                    <div class="card-body">
                        <h3><a href="posts/{{$post->id}}">{{$post->title}}</a></h3>
                        <small>Written on {{ $post->created_at }} by {{ $post->user->name }}</small>
                    </div>
                </div>
            @endif
        @endforeach
        {{ $posts->links() }}
    @else
        <p>Posts not found</p>
    @endif
@endsection