@extends('layouts.app')

@section('title', 'Create New Post')

@section('content')
	<div class="well">
		<h1>Create Post</h1>
		<form action="{{action('Admin\PostsController@store')}}" class="form" method="POST" enctype="multipart/form-data">
			<div class="form-group">
				<label for="category" class="control-label">category</label>
				<select name="category_id" id="category" class="form-control">
				<option value="">---Select Category---</option>
					@if(count($categories) > 0)
						@foreach($categories as $category)
							<option value="{{$category->id}}">{{$category->name}}</option>
						@endforeach
					@else
						<option value="0">No Category</option>
					@endif
				</select>
			</div>

			<div class="form-group">
				<label for="title" class="control-label">Title</label>
				<input type="text" name="title" class="form-control" id="title" value="{{old('title')}}">
			</div>

			<div class="form-group">
				<label for="body" class="control-label">Body</label>
				<textarea name="body" id="article-ckeditor" cols="30" rows="10" class="form-control">{!! old('body') !!}</textarea>
			</div>

			<div class="form-group">
				<label for="cover_image" class="control-label">Image</label>
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