@extends('layouts.app')

@section('title', 'View Lesson')

@section('content')
	<p><a href="/educators/lessons" class="btn btn-default">View All Lessons</a> | <a href="/educators/lessons/create" class="btn btn-primary">Create New Lesson</a></p>

	<div class="panel panel-default">
		<div class="panel-heading">
			<h2>Lesson @if($lesson) {{": " . $lesson->name}} @endif</h2>
		</div>
		<div class="panel-body">
			@if($lesson)
				 @if($lesson->lesson_image == 'noimage.jpg' || $lesson->lesson_image == '')
				 	<p><img style="width: 150px; height: 150px; border-radius: 50%;" src="/public/lesson_images/noimage.jpg"></p>

				 @else
				 	<p><img style="width: 150px; height: 150px; border-radius: 50%;" src="/public/lesson_images/{{$lesson->lesson_image}}"></p>
				 @endif
				<p><b>ID: </b>{{$lesson->id}}</p>
				<p><b>Class: </b>{{$lesson->package->name}}</p>
				<p><b>Subject: </b>{{$lesson->subject->name}}</p>
				<p><b>Lesson Name: </b>{{$lesson->name}}</p>
				<p><b>Description: </b>{!! $lesson->description !!}</p>
				<p><b>Status:</b> @if($lesson->status == 1) Published @else Unpublished @endif
				</p>
				<p><b>Number of Topics: </b>{{$lesson->topic->count()}} &raquo;<a href="/educators/topics/?lesson={{$lesson->id}}"> View Topic(s)</a></p>
				<p><b>Task: <a href="/educators/topics/create/?lesson={{$lesson->id}}"></b> Add New Topic </a> </p>
				<p><b>Created At: </b>{{$lesson->created_at}}</p>
				<p><b>Updated At: </b>{{$lesson->updated_at}}</p>
				<p><b>Creator: </b>{{$lesson->user->username}}</p>
				@if(Auth::user()->id == $lesson->user_id)
				<hr>
				<p><a href="/educators/lessons/{{$lesson->id}}/edit" class="btn btn-success">Edit Lesson</a></p>

				{{-- <form action="{{action('Educator\LessonsController@destroy', $lesson->id)}}" method="POST" class="pull-left add-margin">
				<input type="hidden" name="_method" value="DELETE">
				<input type="hidden" name="_token" value="{{csrf_token()}}">
				<input type="submit" class="btn btn-danger" onclick="return confirm('You have chosen to delete an item. Click OK to continue.')" value="Delete">	</form> --}}
				@endif

			@else

				<p>Sorry, something went wrong. <a href="/educators/packages/" class="btn btn-primary">View Classes</a> | <a href="/educators/subjects/" class="btn btn-primary">View Subjects</a></p>

			@endif
		</div>
	</div>

@endsection