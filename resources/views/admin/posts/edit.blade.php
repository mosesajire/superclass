@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')

	<h1>Edit Post</h1>

	<form action="{{action('Admin\PostsController@update', $post->id)}}" class="form" method="POST" enctype="multipart/form-data">
		<div class="form-group">
			<label for="category" class="control-label">category</label>
			<select name="category_id" id="category" class="form-control">
			<option value="">---Select Category---</option>
				@if(count($categories) > 0)
					@foreach($categories as $category)
						<option value="{{$category->id}}" @if($category->id == $post->category_id) selected="selected @endif" >{{$category->name}}</option>
					@endforeach
				@else
					<option value="0">No Category</option>
				@endif
			</select>
		</div>

		<div class="form-group">
			<label for="title" class="control-label">Title</label>
			<input type="text" name="title" class="form-control" id="title" value="{{$post->title}}">
		</div>

		<div class="form-group">
			<label for="body" class="control-label">Body</label>
			<textarea name="body" id="article-ckeditor" cols="30" rows="10" class="form-control">{!! $post->body !!}</textarea>
		</div>

		<div class="form-group">
			@if($post->cover_image == 'noimage.jpg')
				<label for="cover_image" class="control-label">Upload Image</label>
			@else
				<label for="cover_image" class="control-label">Image Action</label>
				<select name="image_action">
					<option value="retain">Retain Image</option>
					<option value="change">Change Image</option>
					<option value="delete">Delete Image</option>
				</select>
				<br><img style="width: 150px; height: 150px;" src="/public/cover_images/{{$post->cover_image}}">
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