@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="/posts/create" class="btn btn-success mb-3"><i class="fa fa-pencil"></i> New Post</a>
                    <h3>You Blog Posts</h3>
                    @if(count($posts) > 0)
                        <table class="table table-striped">
                            <tr>
                                <th width="80%">Title</th>
                                <th width="10%"></th>
                                <th width="10%"></th>
                            </tr>
                            @foreach($posts as $post)
                                <tr>
                                    <td>{{ $post->title }}</td>
                                    <td><a href="/posts/{{ $post->id }}/edit" class="btn btn-outline-secondary">Edit</a></td>
                                    <td>
                                        <form action="{{route('posts.destroy', $post->id)}}" method="POST" class="pull-right">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="submit" value="Delete" class="btn btn-danger">
                                            {{csrf_field()}}
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <p class="alert alert-info">You have no posts</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
