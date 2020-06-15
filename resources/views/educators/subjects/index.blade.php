@extends('layouts.app')

@section('title', 'Subject Management')

@section('content')
	<p>@if(Auth::user()->role_id == 2)<a href="/educators/subjects/create" class="btn btn-primary">Create New Subject</a> | @endif <a href="/educators/packages" class="btn btn-default">All Classes</a></p>

	<div class="panel panel-default">
		<div class="panel-heading">
			<h2>All Subjects</h2>
		</div>
		<div class="panel-body">
			@if(count($subjects) > 0)

				<table class="table">
					<thead>
						<tr>
							<th>ID</th>
							<th>Name</th>
							<th>Description</th>
							<th>Status</th>
							<th>Created At</th>
							<th>Created By</th>
							<th>Lessons</th>
							<th>Task</th>
						</tr>
					</thead>

					@foreach($subjects as $subject)
						<tbody>
							<tr>
								<td><a href="\educators\subjects\{{$subject->id}}" title="View this subject">{{$subject->id}}</a></td>
								<td><a href="\educators\subjects\{{$subject->id}}" title="View Details">{{$subject->name}}</a></td>
								<td>{!!$subject->description!!}</td>
								<td>@if($subject->status == 1) Published @else Unpublished @endif</td>
								<td>{{$subject->created_at}}</td>
								<td>{{$subject->user->username}}</td>
								<td><a href="/educators/lessons/?subject={{$subject->id}}">{{$subject->lesson->count()}} Lesson(s)</a></td>
								<td><a href="/educators/lessons/create/?subject={{$subject->id}}"> Add Lesson </a></td>
							</tr>
						</tbody>
					@endforeach
				</table>

				{{$subjects->links()}}

			@else

			<p>There is no subject to display. </p>

			@endif
		</div>
	</div>

@endsection