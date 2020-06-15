@extends('layouts.app')

@section('title', 'All Users')

@section('content')

		<div class="panel panel-default">
			<div class="panel-heading">
				<h2>List of Users</h2>
			</div>
			@if(count($users) > 0)
				<table class="table">
					<thead>
						<tr>
							<th>ID</th>
							<th>First Name</th>
							<th>Last Name</th>
							<th>Username</th>
							<th>Email</th>
							<th>Joined At</th>
							<th>Role</th>
							<th>Group</th>
						</tr>
					</thead>
					<tbody>
					@foreach($users as $user)
						<tr>
							<td><a href="users/{{$user->id}}">{{$user->id}}</a></td>
							<td>{{$user->first_name}}</td>
							<td>{{$user->last_name}}</td>
							<td>{{$user->username}}</td>
							<td><a href="users/{{$user->id}}">{{$user->email}}</a></td>
							<td>{{$user->created_at}}</td>
							<td>{{$user->role->name}}</td>
							<td>{{$user->group->name}}</td>
						</tr>
					@endforeach
					</tbody>
				</table>
			@else
				<p>There is no user yet.</p>
			@endif
		</div>

@endsection