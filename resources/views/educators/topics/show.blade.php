@extends('layouts.app')

@section('title', 'View Lesson')

@section('content')
	<p><a href="/educators/topics" class="btn btn-default">View All Topics</a> | <a href="/educators/topics/create" class="btn btn-primary">Create New Topic</a></p>

	<div class="panel panel-default">
		<div class="panel-heading">
			<h2>Topic @if($topic) {{": " . $topic->name}} @endif</h2>
		</div>
		<div class="panel-body">
			@if($topic)
				<p><b>ID: </b>{{$topic->id}}</p>
				<p><b>Class: </b>{{$topic->lesson->package->name}}</p>
				<p><b>Subject: </b>{{$topic->lesson->subject->name}}</p>
				<p><b>Lesson: </b>{{$topic->lesson->name}}</p>
				<p><b>Topic: </b>{{$topic->title}}</p>
				<p><b>Body: </b>{!! $topic->body !!}</p>
				<p><b>Status:</b> @if($topic->status == 1) Published @else Unpublished @endif
				</p>
				<p><b>Created At: </b>{{$topic->created_at}}</p>
				<p><b>Updated At: </b>{{$topic->updated_at}}</p>
				<p><b>Creator: </b>{{$topic->user->username}}</p>
				<hr>
				<p><a href="/educators/topics/{{$topic->id}}/edit" class="btn btn-success">Edit Topic</a></p>

				{{-- <form action="{{action('Educator\TopicsController@destroy', $topic->id)}}" method="POST" class="pull-left add-margin">
				<input type="hidden" name="_method" value="DELETE">
				<input type="hidden" name="_token" value="{{csrf_token()}}">
				<input type="submit" class="btn btn-danger" onclick="return confirm('You have chosen to delete an item. Click OK to continue.')" value="Delete">	</form> --}}

			@else

				<p>Sorry, something went wrong. <a href="/educators/topics/" class="btn btn-primary">View Topics</a></p>

			@endif
		</div>
	</div>

@endsection