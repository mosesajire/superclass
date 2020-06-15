@extends('layouts.app')

@section('title', 'Topic Management')

@section('content')
	<p><a href="/educators/topics/create" class="btn btn-primary">Create New Topic</a> | <a href="/educators/lessons" class="btn btn-default">All Lessons</a> | <a href="/educators/subjects" class="btn btn-default">All Subjects</a> | <a href="/educators/packages" class="btn btn-default">All Classes</a></p>
	<hr>
	
	<div class="panel panel-default">
		<div class="panel-heading">
			<h2>Topics @if(isset($get_lesson)) for <a href="/educators/lessons/{{$get_lesson->id}}">{{$get_lesson->name}}</a> | <a href="/educators/topics" class="btn btn-default">Go to All Topics</a>@endif</h2>
		</div>
		<div class="panel-body">
			@if(count($topics) > 0)
				<table class="table">
					<thead>
						<tr>
							<th>ID</th>
							<th>Class</th>
							<th>Subject</th>
							<th>Lesson</th>
							<th>Topic</th>
							<th>Status</th>
							<th>Created At</th>
							<th>Created By</th>
						</tr>
					</thead>

					@foreach($topics as $topic)
						<tbody>
							<tr>
								<td><a href="\educators\topics\{{$topic->id}}">{{$topic->id}}</a></td>
								<td>{{$topic->lesson->package->name}}</td>
								<td>{{$topic->lesson->subject->name}}</td>
								<td>
								@if(!(isset($_GET['lesson'])))
									<a href="/educators/topics/?lesson={{$topic->lesson->id}}" title="View Topics of '{{$topic->lesson->name}}'">{{$topic->lesson->name}}</a>
								@else
									{{$topic->lesson->name}}
								@endif
								</td>
								<td><a href="\educators\topics\{{$topic->id}}" title="View Details">{{$topic->title}}</a></td>
								<td>@if($topic->status == 1) Published @else Unpublished @endif</td>
								<td>{{$topic->created_at}}</td>
								<td>{{$topic->user->username}}</td>
							</tr>
						</tbody>
					@endforeach
				</table>
				{{$topics->links()}}
			@else

			<p>There is no topic to display yet. </p>

			@endif
		</div>
	</div>

@endsection