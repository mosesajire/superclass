@extends('layouts.app')

@section('title', 'View Class')

@section('content')
	<p> <a href="/educators/packages" class="btn btn-default">View All Classes</a> @if(Auth::user()->role_id == 2) | <a href="/educators/packages/create" class="btn btn-primary">Create New Class</a> @endif</p>

	<div class="panel panel-default">
		<div class="panel-heading">
			<h2>Class @if($package) {{": " . $package->name}} @endif</h2>
		</div>
		<div class="panel-body">
			@if($package)
				 @if($package->package_image == 'noimage.jpg' || $package->package_image == '')
				 	<p><img style="width: 150px; height: 150px; border-radius: 50%;" src="/public/package_images/noimage.jpg"></p>

				 @else
				 	<p><img style="width: 150px; height: 150px; border-radius: 50%;" src="/public/package_images/{{$package->package_image}}"></p>
				 @endif
				<p><b>ID: </b>{{$package->id}}</p>
				<p><b>Class Name: </b>{{$package->name}}</p>
				<p><b>Description: </b>{!! $package->description !!}</p>
				<p><b>Status:</b> @if($package->status == 1) Published @else Unpublished @endif
				</p>
				<p><b>Number of Lessons: </b>{{$package->lesson->count()}} &raquo;<a href="/educators/lessons/?package={{$package->id}}"> View Lessons(s)</a></p>
				<p><b>Task: </b><a href="/educators/lessons/create/?package={{$package->id}}"> Add New Lesson</a></p>
				<p><b>Created At: </b>{{$package->created_at}}</p>
				<p><b>Updated At: </b>{{$package->updated_at}}</p>
				<p><b>Creator: </b>{{$package->user->username}}</p>
				@if(Auth::user()->role_id == 2)
					<hr>
					<p><a href="/educators/packages/{{$package->id}}/edit" class="btn btn-success">Edit Package</a></p>

					{{-- <form action="{{action('Educator\PackagesController@destroy', $package->id)}}" method="POST" class="pull-left add-margin">
					<input type="hidden" name="_method" value="DELETE">
					<input type="hidden" name="_token" value="{{csrf_token()}}">
					<input type="submit" class="btn btn-danger" onclick="return confirm('You have chosen to delete an item. Click OK to continue.')" value="Delete">	</form> --}}
				@endif
			@else

				<p>Sorry, something went wrong. <a href="/educators/packages/" class="btn btn-primary">View Classes</a></p>

			@endif
		</div>
	</div>

@endsection