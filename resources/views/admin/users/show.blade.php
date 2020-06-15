@extends('layouts.app')

@section('title', 'User')

@section('content')

	<p><a href="/admin/users" class="btn btn-primary">Back</a></p>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h2>User #{{$user->id}}</h2>
		</div>
		<div class="panel-body">
			<p><b>First Name:</b> {{$user->first_name}}</p>
			<p><b>Last Name:</b> {{$user->last_name}}</p>
			<p><b>Username:</b> {{$user->username}}</p>
			<p><b>Email:</b> {{$user->email}}</p>
			<p><b>Password:</b> ******</p>
			<p><b>Role:</b> {{$user->role->name}}</p>
			<p><b>Group:</b> {{$user->group->name}}</p>
			<p><b>Status:</b> @if($user->status == 1) {{"Active"}} @else {{"Inactive"}} @endif</p>
			<hr>
			<p><a href="/admin/users/{{$user->id}}/edit" class="btn btn-primary pull-left add-margin">Edit</a></p>
		</div>
	</div>

@endsection