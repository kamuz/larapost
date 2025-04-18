@extends('layouts.app')

@section('content')
    <h1>Create Post</h1>
    <form action="{{route('posts.update', $post->id)}}" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" placeholder="Title" value="{{ $post->title }}">
        </div>
        <div class="form-group">
            <label for="body">Body</label>
            <textarea name="body" id="body" class="form-control" placeholder="Body" cols="30" rows="10">{{ $post->body }}</textarea>
        </div>
        <img src="/public/storage/images/{{ $post->image }}" alt="{{ $post->title }}" class="img-thumbnail img-fluid mb-3">
        <div class="form-group">
            <input type="file" name="image" id="image">
        </div>
        <input type="hidden" name="_method" value="PUT">
        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
        {{csrf_field()}}
        <a href="/posts" class="btn btn-danger"><i class="fa fa-remove"></i> Cancel</a>
    </form>
@endsection