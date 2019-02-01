@extends('layouts.app')

@section('content')
    <h1>Create Post</h1>
    <form action="{{route('posts.store')}}" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" placeholder="Title">
        </div>
        <div class="form-group">
            <label for="body">Body</label>
            <textarea name="body" id="body" class="form-control" placeholder="Body" cols="30" rows="10"></textarea>
        </div>
        <div class="form-group">
            <input type="file" name="image" id="image">
        </div>
        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Submit</button>
        {{csrf_field()}}
        <a href="/posts" class="btn btn-danger"><i class="fa fa-remove"></i> Cancel</a>
    </form>
@endsection