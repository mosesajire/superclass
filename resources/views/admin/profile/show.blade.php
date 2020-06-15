@extends('layouts.app')

@section('title', 'Profile')

@section('content')

	<div class="panel panel-success">
		<div class="panel-heading">Manage Your Profile</div>
		<div class="panel-body">
			 @if($user->picture == 'noimage.jpg' || $user->picture == '')
			 	<p><img style="width: 150px; height: 150px; border-radius: 50%;" src="/public/profile_pictures/noimage.jpg"></p>
			 
			 @else
			 	<p><img style="width: 150px; height: 150px; border-radius: 50%;" src="/public/profile_pictures/{{$user->picture}}"></p>
			 @endif

			<p><b>First Name: </b> {{$user->first_name}}</p>
			<p><b>Last Name: </b> {{$user->last_name}}</p>
			<p><b>Username: </b> {{$user->username}}</p>
			<p><b>Email: </b> {{$user->email}}</p>
			<p><b>Password: </b> ****** </p>
			<p><b>Date Joined: </b> {{$user->created_at}}</p>
			<hr>
			@if($user->id == Auth::user()->id)
			<a href="/admin/profile/{{$user->id}}/edit" class="btn btn-success">Update Profile</a>
			@endif
		</div>
	</div>

@endsection