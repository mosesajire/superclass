@extends('layouts.app')

@section('title', 'Category Management')

@section('content')
	<a href="/admin/categories/create" class="btn btn-primary">Create New Category</a>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h2>All Categories</h2>
		</div>
		<div class="panel-body">
			@if(count($categories) > 0)

				<table class="table">
					<thead>
						<tr>
							<th>ID</th>
							<th>Name</th>
							<th>Created At</th>
							<th>Created By</th>
						</tr>
					</thead>

					@foreach($categories as $category)
						<tbody>
							<tr>
								<td>{{$category->id}}</td>
								<td><a href="\admin\categories\{{$category->id}}">{{$category->name}}</a></td>
								<td>{{$category->created_at}}</td>
								<td>{{$category->user->username}}</td>
							</tr>
						</tbody>
					@endforeach
				</table>

			@else

			<p>There is no category to display. <a href="categories/create" class="btn btn-primary">Create New Category</a></p>

			@endif
		</div>
	</div>

@endsection