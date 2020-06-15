@extends('layouts.app')

@section('title', 'Create Role')

@section('content')

	<p><a href="/admin/roles/" class="btn btn-default">View Roles</a></p>
	<div class="well">
		<legend>Create a new role</legend>
		<form action="/admin/roles/create" class="form" method="post">
			<div class="form-group">
				<label for="name" class="control-label">Name</label>
				<input type="text" name="name" id="name" class="form-control">
			</div>

			<div class="form-group">
				<label for="description" class="control-label">Description</label>
				<textarea name="description" id="description" cols="30" rows="5" class="form-control"></textarea>
			</div>

			<input type="hidden" name="_token" value="{{csrf_token()}}">

			<input type="hidden" name="_method" value="POST">

			<div class="form-group">
				<button type="reset" class="btn btn-default">Cancel</button>
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</form>
	</div>


@endsection