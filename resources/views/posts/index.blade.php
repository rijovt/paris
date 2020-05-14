@extends('layouts.app')

@section('content')
<h1>Posts</h1>
	@if(count($Posts))
	<div class="card">
		<ul class="list-group list-group-flush">
		@foreach($Posts as $post)
			<li class="list-group-item">
				<h1><a href="posts/{{$post->id}}">{{$post->title}}</a></h1>
				<small>writen on: {{$post->created_at}}</small>
			</li>
		@endforeach
		</ul>
		</div>
	@endif
@endsection
