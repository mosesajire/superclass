@extends('layouts.app')

@section('title', 'View Category')

@section('content')
	<a href="/admin/categories/create" class="btn btn-primary">Create New Category</a>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h2>View Category @if($category) {{": " . $category->name}} @endif</h2>
		</div>
		<div class="panel-body">
			@if($category)

				<p><b>ID: </b>{{$category->id}}</p>
				<p><b>Name: </b>{{$category->name}}</p>
				<p><b>Description: </b>{!! $category->description !!}</p>
				<p><b>Created At: </b>{{$category->created_at}}</p>
				<p><b>Updated At: </b>{{$category->updated_at}}</p>
				<p><b>Creator: </b>{{$category->user->username}}</p>
				<hr>
				<a href="/admin/categories/{{$category->id}}/edit" class="btn btn-default pull-left add-margin">Edit</a>

				<form action="{{action('Admin\CategoriesController@destroy', $category->id)}}" method="POST" class="pull-left add-margin">
				<input type="hidden" name="_method" value="DELETE">
				<input type="hidden" name="_token" value="{{csrf_token()}}">
				<input type="submit" class="btn btn-danger" onclick="return confirm('You have chosen to delete an item. Click OK to continue.')" value="Delete">				</form>

			@else

				<p>Sorry, something went wrong. <a href="/admin/categories/" class="btn btn-primary">View Categories</a></p>

			@endif
		</div>
	</div>

@endsection