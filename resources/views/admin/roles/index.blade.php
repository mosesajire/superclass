@extends('layouts.app')

@section('title', 'All Roles')

@section('content')
	<p><a href="/admin/roles/create" class="btn btn-default">Create New Role</a></p>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h2>All Roles</h2>
		</div>
		@if(count($roles) > 0)
		<div class="panel-body">
			<table class="table">
				<thead>
					<tr>
						<th>Role ID</th>
						<th>Name</th>
						<th>Description</th>
					</tr>
				</thead>
				@foreach($roles as $role)
					<tbody>
						<tr>
							<td>{!! $role->id !!}</td>
							<td>{!! $role->name !!}</td>
							<td>{!! $role->description !!}</td>
						</tr>
					</tbody>
				@endforeach
			</table>
		</div>
		@else
			<p>There is no role to display. Create a new role <a href="/admin/roles/create">here</a></p>
		@endif
	</div>

@endsection