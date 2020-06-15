@extends('layouts.app')

@section('title', 'View Subject')

@section('content')
	<p><a href="/educators/subjects" class="btn btn-default">View All Subjects</a> @if(Auth::user()->role_id == 2) | <a href="/educators/subjects/create" class="btn btn-primary">Create New Subject</a> @endif </p>

	<div class="panel panel-default">
		<div class="panel-heading">
			<h2>Subject @if($subject) {{": " . $subject->name}} @endif</h2>
		</div>
		<div class="panel-body">
			@if($subject)
				 @if($subject->subject_image == 'noimage.jpg' || $subject->subject_image == "")
				 	<p><img style="width: 150px; height: 150px; border-radius: 50%;" src="/public/subject_images/noimage.jpg"></p>

				 @else
				 	<p><img style="width: 150px; height: 150px; border-radius: 50%;" src="/public/subject_images/{{$subject->subject_image}}"></p>
				 @endif
				<p><b>ID: </b>{{$subject->id}}</p>
				<p><b>Subject Name: </b>{{$subject->name}}</p>
				<p><b>Description: </b>{!! $subject->description !!}</p>
				<p><b>Status:</b> @if($subject->status == 1) Published @else Unpublished @endif
				</p>
				<p><b>Number of Lessons: </b>{{$subject->lesson->count()}} &raquo;<a href="/educators/lessons/?subject={{$subject->id}}"> View Lesson(s)</a></p>
				<p><b>Task: </b><a href="/educators/lessons/create/?subject={{$subject->id}}"> Add New Lesson </a></p>
				<p><b>Created At: </b>{{$subject->created_at}}</p>
				<p><b>Updated At: </b>{{$subject->updated_at}}</p>
				<p><b>Creator: </b>{{$subject->user->username}}</p>
				@if(Auth::user()->role_id == 2)
					<hr>
					<p><a href="/educators/subjects/{{$subject->id}}/edit" class="btn btn-success">Edit Subject</a></p>

					{{-- <form action="{{action('Educator\SubjectsController@destroy', $subject->id)}}" method="POST" class="pull-left add-margin">
					<input type="hidden" name="_method" value="DELETE">
					<input type="hidden" name="_token" value="{{csrf_token()}}">
					<input type="submit" class="btn btn-danger" onclick="return confirm('You have chosen to delete an item. Click OK to continue.')" value="Delete">	</form> --}}
				@endif
			@else

				<p>Sorry, something went wrong. <a href="/educators/subjects/" class="btn btn-primary">View Subjects</a></p>

			@endif
		</div>
	</div>

@endsection