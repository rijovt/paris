@extends('layouts.app')

@section('content')
<a href="/posts" class="btn btn-outline-primary">Go back</a>
<div class="row">
  <div class="col-md-4">
    <img src="/storage/uploads/{{$post->cover_image}}" alt="">
  </div>
  <div class="col-md-8">
    <h1>{{$post->title}}</h1>
    <p>{{$post->body}}</p>
  </div>
</div>
<hr>
<small>Written On:{{$post->created_at}}</small>
<br>
@if(!Auth::guest())
  @if (Auth::user()->id==$post->user_id)
    <a href="/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a>
    {{Form::open(['action'=>['PostsController@destroy',$post->id],'method'=>'DELETE','class'=>'pull_right'])}}
      {{Form::submit('DELETE',['class'=>'btn btn-danger'])}}
    {{Form::close()}}
  @endif
@endif
@endsection
