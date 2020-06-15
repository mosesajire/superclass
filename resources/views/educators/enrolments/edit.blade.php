@extends('layouts.app')

@section('title', 'Edit Student Enrolment')

@section('content')

	<p><a href="/educators/enrolments" class="btn btn-default">View All Enrolled Students</a></p>

	<div class="well">
		<legend>Edit Student Enrolment</legend>
		<form action="{{action('Educator\EnrolmentsController@update', $enrolment->id)}}" class="form" method="POST">

			<div class="form-group">
				<label for="user">Select User</label>
				<select name="user_id" id="user" class="form-control">
				<option value="">---Select User--</option>
					@if(count($users) > 0)
						@foreach($users as $user)
							<option value="{{$user->id}}" @if($user->id == $enrolment->user_id) selected="selected" @endif>{{$user->first_name}} {{$user->last_name}} ({{$user->email}})</option>
						@endforeach
					@else
						<option value="0">No User</option>
					@endif
				</select>
			</div>

			<div class="form-group">
				<label for="lesson">Select Lesson</label>
				<select name="lesson_id" id="lesson" class="form-control">
				<option value="">---Select Lesson--</option>
					@if(count($lessons) > 0)
						@foreach($lessons as $lesson)
							<option value="{{$lesson->id}}"  @if($lesson->id == $enrolment->lesson_id) selected="selected" @endif>{{$lesson->name}}</option>
						@endforeach
					@else
						<option value="0">No Lesson</option>
					@endif
				</select>
			</div>

			<div class="form-group">
				<label for="status">Status: </label>
				<select name="status" id="status">
					<option value="">--Select Status--</option>
					<option value="1" @if($enrolment->status == 1) selected="selected" @endif>Active</option>
					<option value="0" @if($enrolment->status == 0) selected="selected" @endif>Inactive</option>
				</select>
			</div>

			<input type="hidden" name="_token" value="{{csrf_token()}}">
			<input type="hidden" name="_method" value="PUT">
			<div class="form-group">
				<button type="reset" class="btn btn-default">Cancel</button>
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</form>
	</div>

@endsection