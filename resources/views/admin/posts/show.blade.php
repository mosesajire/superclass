@extends('layouts.app')

@section('title', 'Post')

@section('content')
	<a href="/admin/posts" class="btn btn-default">Go Back</a>
	<div class="well">
		<p>Category: {{$post->category->name}}</p>
		<h1>{{$post->title}}</h1>
		@if($post->cover_image !== "noimage.jpg")
			<img style="width: 100%; max-height: 300px;" src="/public/cover_images/{{$post->cover_image}}">
		@endif
		<p>{!!$post->body!!}</p>
		<small>Written on {{$post->created_at}} by {{$post->user->username}}</small>
	</div>
	<hr>
	{{-- Only display links to registered users. --}}

	@if(!Auth::guest())


		<a href="/admin/posts/{{$post->id}}/edit" class="btn btn-default pull-left add-margin">Edit</a>
		<form action="{{action('Admin\PostsController@destroy', $post->id)}}" class="form add-margin pull-left" method="POST">
			<input type="hidden" name="_method" value="DELETE">
			<input type="hidden" name="_token" value="{{csrf_token()}}">
			<input type="submit" name="submit" value="Delete" class="btn btn-danger" onclick="return confirm('You have chosen to delete an item. Click OK to continue.')">
		</form>

	@endif
@endsection