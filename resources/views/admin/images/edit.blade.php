@extends('layouts.app')

@section('title', 'Edit Image')

@section('content')

	<p><a href="/admin/images" class="btn btn-default">View All Images</a></p>

	<h1>Edit Image</h1>

	<form action="{{action('Admin\ImagesController@update', $image->id)}}" class="form" method="POST" enctype="multipart/form-data">

		<div class="form-group">
				<label for="name" class="control-label">Image Name</label>
				<input type="text" name="name" class="form-control" id="title" value="{{$image->name}}">
			</div>

			<div class="form-group">
				<label for="description" class="control-label">Image Description</label>
				<textarea name="description" id="article-ckeditor" cols="30" rows="10" class="form-control">{!! $image->description!!}</textarea>
			</div>

		<div class="form-group">
			@if($image->path == 'noimage.jpg')
				<label for="cover_image" class="control-label">Upload Image</label>
			@else
				<label for="cover_image" class="control-label">Image Action</label>
				<select name="image_action">
					<option value="retain">Retain Image</option>
					<option value="change">Change Image</option>
					<option value="delete">Delete Image</option>
				</select>
				<br><img style="width: 150px; height: 150px;" src="/public/cover_images/{{$image->path}}">
			@endif

			<input type="file" name="cover_image">
		</div>

		<input type="hidden" name="_method" value="PUT">
		<input type="hidden" name="_token" value="{{csrf_token()}}">
		<input type="hidden" name="user_id" value="{{Auth::user()->id}}">
		<input type="hidden" name="status" value="1">

		<input type="reset" name="reset" value="Reset" class="btn btn-default">
		<input type="submit" name="submit" value="Submit" class="btn btn-primary">
	</form>

@endsection