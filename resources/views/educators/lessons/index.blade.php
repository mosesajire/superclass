@extends('layouts.app')

@section('title', 'Lesson Management')

@section('content')
	<p><a href="/educators/lessons/create" class="btn btn-primary">Create New Lesson</a> | <a href="/educators/subjects" class="btn btn-default">All Subjects</a> | <a href="/educators/packages" class="btn btn-default">All Classes</a></p>

	<div class="panel panel-default">
		<div class="panel-heading">
			<h2>Lessons 
			@if(isset($get_subject)) for <a href="/educators/subjects/{{$get_subject->id}}">{{$get_subject->name}}</a> | <a href="/educators/lessons" class="btn btn-default">Go to All Lessons</a>@endif
			@if(isset($get_package)) for <a href="/educators/packages/{{$get_package->id}}">{{$get_package->name}}</a> | <a href="/educators/lessons" class="btn btn-default">Go to All Lessons</a>@endif
			</h2>
		</div>
		<div class="panel-body">
			@if(count($lessons) > 0)

				<table class="table">
					<thead>
						<tr>
							<th>ID</th>
							<th>Class</th>
							<th>Subject</th>
							<th>Lesson</th>
							<th>Status</th>
							<th>Created At</th>
							<th>Created By</th>
							<th>Topics</th>
							<th>Task</th>
						</tr>
					</thead>

					@foreach($lessons as $lesson)
						<tbody>
							<tr>
								<td><a href="\educators\lessons\{{$lesson->id}}">{{$lesson->id}}</a></td>
								<td>
								@if(!(isset($_GET['package'])))
									<a href="/educators/lessons/?package={{$lesson->package->id}}" title="View Lessons of {{$lesson->package->name}}">{{$lesson->package->name}}</a>
								@else
									{{$lesson->package->name}}
								@endif
								</td>
								<td>
								@if(!(isset($_GET['subject'])))
									<a href="/educators/lessons/?subject={{$lesson->subject->id}}" title="View Lessons of {{$lesson->subject->name}}">{{$lesson->subject->name}}</a>
								@else
									{{$lesson->subject->name}}
								@endif
								</td>
								<td><a href="\educators\lessons\{{$lesson->id}}" title="View Details">{{$lesson->name}}</a></td>
								<td>@if($lesson->status == 1) Published @else Unpublished @endif</td>
								<td>{{$lesson->created_at}}</td>
								<td>{{$lesson->user->username}}</td>
								<td><a href="/educators/topics/?lesson={{$lesson->id}}">{{$lesson->topic->count()}} Topic(s)</a></td>
								<td><a href="/educators/topics/create/?lesson={{$lesson->id}}" title="Add New Topic"> Add Topic</a></td>
							</tr>
						</tbody>
					@endforeach
				</table>
				{{$lessons->links()}}
			@else

			<p>There is no lesson to display yet. </p>

			@endif
		</div>
	</div>

@endsection