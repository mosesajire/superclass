@extends('layouts.app')

@section('title', 'Class Management')

@section('content')
	<p>@if(Auth::user()->role_id == 2)<a href="/educators/packages/create" class="btn btn-primary">Create New Class</a> |@endif <a href="/educators/subjects" class="btn btn-default">All Subjects</a></p>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h2>All Classes</h2>
		</div>
		<div class="panel-body">
			@if(count($packages) > 0)

				<table class="table">
					<thead>
						<tr>
							<th>ID</th>
							<th>Class Name</th>
							<th>Status</th>
							<th>Created At</th>
							<th>Created By</th>
							<th>Lessons</th>
							<th>Task</th>
						</tr>
					</thead>

					@foreach($packages as $package)
						<tbody>
							<tr>
								<td>{{$package->id}}</td>
								<td><a href="\educators\packages\{{$package->id}}" title="View Details">{{$package->name}}</a></td>
								<td>@if($package->status == 1) Published @else Unpublished @endif</td>
								<td>{{$package->created_at}}</td>
								<td>{{$package->user->username}}</td>
								<td><a href="/educators/lessons/?package={{$package->id}}">{{$package->lesson->count()}} Lesson(s)</a></td>
								<td><a href="/educators/lessons/create/?package={{$package->id}}"> Add Lesson</a></td>
							</tr>
						</tbody>
					@endforeach
				</table>
				{{$packages->links()}}
			@else

			<p>There is no class to display. </p>

			@endif
		</div>
	</div>

@endsection