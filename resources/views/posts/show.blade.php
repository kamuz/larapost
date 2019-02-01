@extends('layouts.app')

@section('content')
    <a href="/posts" class="btn btn-outline-secondary"><i class="fa fa-backward"></i> Go Back</a>
    <div class="card mt-3 mb-3">
        <div class="card-body">
            <h1>{{$post->title}}</h1>
            <p><small>{{$post->created_at}}</small></p>
            @if($post->image)
                <img src="/storage/images/{{ $post->image }}" alt="{{ $post->title }}" class="img-thumbnail img-fluid">
            @endif
            <div class="mt-3">{{$post->body}}</div>
        </div>
    </div>
    @if(!Auth::guest())
        @if(Auth::user()->id == $post->user_id)
            <a href="/posts/{{$post->id}}/edit" class="btn btn-secondary"><i class="fa fa-pencil"></i> Edit Post</a>
            <form action="{{route('posts.destroy', $post->id)}}" method="POST" class="pull-right mb-3">
                <input type="hidden" name="_method" value="DELETE">
                <button type="submit" class="btn btn-danger"><i class="fa fa-remove"></i> Delete Post</button>
                {{csrf_field()}}
            </form>
        @endif
    @endif
@endsection