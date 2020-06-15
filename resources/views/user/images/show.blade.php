@extends('layouts.app')

@section('title', 'Image')

@section('content')
	<a href="/user/images" class="btn btn-default">Go Back</a>
	<div class="well">
		@if($image->path !== "noimage.jpg")
			<img style="width: auto; max-height: 300px;" src="/public/cover_images/{{$image->path}}">
		@endif
		<h2>Image URL: {{$image->path}}</h2>
		<h3>Image Name: {{$image->name}}</h3>
		<p>Image Description: {!!$image->description!!}</p>
		<small>Uploaded on {{$image->created_at}} by {{$image->user->first_name}}</small>
	</div>
	<hr>
	{{-- Only display links to registered users. --}}

	@if(!Auth::guest())


		<a href="/user/images/{{$image->id}}/edit" class="btn btn-default pull-left add-margin">Edit</a>
		<form action="{{action('User\ImagesController@destroy', $image->id)}}" class="form add-margin pull-left" method="POST">
			<input type="hidden" name="_method" value="DELETE">
			<input type="hidden" name="_token" value="{{csrf_token()}}">
			<input type="submit" name="submit" value="Delete" class="btn btn-danger" onclick="return confirm('You have chosen to delete an item. Click OK to continue.')">
		</form>

	@endif
@endsection