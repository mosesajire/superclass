@extends('layouts.app')

@section('title', 'Enrolment Management')

@section('content')

	<div class="panel panel-default">
		<div class="panel-heading">
			<h2>All Enrolled Students</h2>
		</div>
		<div class="panel-body">
			@if(count($enrolments) > 0)

				<table class="table">
					<thead>
						<tr>
							<th>ID</th>
							<th>Package</th>
							<th>Subject</th>
							<th>Lesson</th>
							<th>Student</th>
							<th>Status</th>
							<th>Created At</th>
							@if(Auth::user()->role_id == 2)
							<th>Task</th>
							@endif
						</tr>
					</thead>

					@foreach($enrolments as $enrolment)
						<tbody>
							<tr>
								<td>{{$enrolment->id}}</td>
								<td>{{$enrolment->lesson->package->name}}</td>
								<td>{{$enrolment->lesson->subject->name}}</td>
								<td>{{$enrolment->lesson->name}}</td>
								<td>{{$enrolment->user->first_name}} {{$enrolment->user->last_name}} </td>
								<td>@if($enrolment->status == 1) Active @else Inactive @endif</td>
								<td>{{$enrolment->created_at}}</td>

								@if(Auth::user()->role_id == 2)
								<td><a href="/educators/enrolments/{{$enrolment->id}}/edit">Edit Enrolment</a></td>
								@endif

							</tr>
						</tbody>
					@endforeach
				</table>

				{{$enrolments->links()}}

			@else

			<p>There is no enrolment to display yet. </p>

			@endif
		</div>
	</div>

@endsection