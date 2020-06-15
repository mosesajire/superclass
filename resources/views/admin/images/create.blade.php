@extends('layouts.app')

@section('title', 'Upload New Image')

@section('content')

	<p><a href="/admin/images" class="btn btn-default">View All Images</a></p>


	<div class="well">
		<h1>Upload New Image</h1>
		<form action="{{action('Admin\ImagesController@store')}}" class="form" method="POST" enctype="multipart/form-data">

			<div class="form-group">
				<label for="name" class="control-label">Image Name</label>
				<input type="text" name="name" class="form-control" id="title" value="{{old('name')}}">
			</div>

			<div class="form-group">
				<label for="description" class="control-label">Image Description</label>
				<textarea name="description" id="article-ckeditor" cols="30" rows="10" class="form-control">{{old('description')}}</textarea>
			</div>

			<div class="form-group">
				<label for="cover_image" class="control-label">Upload Image</label>
				<input type="file" name="cover_image">
			</div>

			<input type="hidden" name="_method" value="POST">
			<input type="hidden" name="_token" value="{{csrf_token()}}">
			<input type="hidden" name="user_id" value="{{Auth::user()->id}}">
			<input type="hidden" name="status" value="1">

			<input type="reset" name="reset" value="Reset" class="btn btn-default">
			<input type="submit" name="submit" value="Submit" class="btn btn-primary">
		</form>
	</div>

@endsection