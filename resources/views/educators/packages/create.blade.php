@extends('layouts.app')

@section('title', 'Create Class')

@section('content')

	<p><a href="/educators/packages" class="btn btn-default">View All Classes</a></p>

	<div class="well">
		<legend>Create New Class</legend>
		@if(Auth::user()->role_id == 2)
		<form action="{{action('Educator\PackagesController@store')}}" class="form" method="POST" enctype="multipart/form-data">
			<div class="form-group">
				<label for="name">Name</label>
				<input type="text" name="name" id="name" class="form-control" value="{{old('name')}}">
			</div>

			<div class="form-group">
				<label for="description">Description</label>
				<textarea name="description" id="article-ckeditor" cols="30" rows="5" class="form-control">{{old('description')}}</textarea>
			</div>

			<div class="form-group">
				<label for="status">Status: </label>
				<select name="status" id="status">
					<option value="">--Select Status--</option>
					<option value="1">Publish</option>
					<option value="0">Unpublish</option>
				</select>
			</div>

			<div class="form-group">
				<label for="package_image">Class Image</label>
				<input type="file" name="package_image">
			</div>

			<input type="hidden" name="user_id" value="{{Auth::user()->id}}">
			<input type="hidden" name="_token" value="{{csrf_token()}}">
			<input type="hidden" name="_method" value="POST">
			<div class="form-group">
				<button type="reset" class="btn btn-default">Cancel</button>
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</form>
		@else
			<p class="text-info">Sorry, something went wrong. Access denied.</p>
		@endif
	</div>

@endsection