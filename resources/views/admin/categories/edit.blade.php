@extends('layouts.app')

@section('title', 'Edit Category')

@section('content')

	<a href="/admin/categories" class="btn btn-primary">View All Categories</a>

	<div class="well">
		@if(count($category) == 1)

		<legend>Edit Category: {{$category->name}}</legend>
		<form action="{{action('Admin\CategoriesController@update', $category->id)}}" class="form" method="POST">
			<div class="form-group">
				<label for="name" class="control-label">Name</label>
				<input type="text" name="name" id="name" class="form-control" value="{{$category->name}}">
			</div>

			<div class="form-group">
				<label for="description" class="control-label">Description</label>
				<textarea name="description" id="article-ckeditor" cols="30" rows="5" class="form-control">{!! $category->description !!}</textarea>
			</div>

			<input type="hidden" name="user_id" value="{{$category->user_id}}">

			<input type="hidden" name="id" value="{{$category->id}}">

			<input type="hidden" name="_token" value="{{csrf_token()}}">

			<input type="hidden" name="_method" value="PUT">
			<div class="form-group">
				<button type="reset" class="btn btn-default">Cancel</button>
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</form>

		@else
			<p>Sorry, something went wrong. Please try again.</p>
		@endif
	</div>

@endsection