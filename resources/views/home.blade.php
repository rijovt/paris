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
                    <a href="/posts/create" class="btn btn-primary">Add New Post</a>
                    <h1>Your Blog Posts</h1>

                    @if (count(Auth::user()->posts))
                    <table class="table table-striped">
                      <tr>
                        <th>Title</th>
                        <th></th>
                        <th></th>
                      </tr>
                      @foreach (Auth::user()->posts as $post)
                        <tr>
                          <td>{{$post->title}}</td>
                          <td><a href="/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a></td>
                          <td></td>
                        </tr>
                      @endforeach
                    </table>
                    @else
                    <p>No posts found !! </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
