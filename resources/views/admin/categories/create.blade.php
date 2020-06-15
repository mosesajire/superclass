@extends('layouts.app')

@section('title', 'Create Category')

@section('content')

	<a href="/admin/categories" class="btn btn-primary">View All Categories</a>

	<div class="well">
		<legend>Create New Category</legend>
		<form action="{{action('Admin\CategoriesController@store')}}" class="form" method="POST">
			<div class="form-group">
				<label for="name" class="control-label">Name</label>
				<input type="text" name="name" id="name" class="form-control" value="{{old('name')}}">
			</div>

			<div class="form-group">
				<label for="description" class="control-label">Description</label>
				<textarea name="description" id="article-ckeditor" cols="30" rows="5" class="form-control">{{old('description')}}</textarea>
			</div>

			<input type="hidden" name="user_id" value="{{Auth::user()->id}}">
			<input type="hidden" name="_token" value="{{csrf_token()}}">
			<input type="hidden" name="_method" value="POST">
			<div class="form-group">
				<button type="reset" class="btn btn-default">Cancel</button>
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</form>
	</div>

@endsection