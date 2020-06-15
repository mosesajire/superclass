@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="row">
	<div class="col-sm-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4>Your Dashboard</h4>
			</div>

			<div class="panel-body">
				<ul>
					<li><a href="/user/profile/{{Auth::user()->id}}">Manage Your Profile</a></li>
					<hr>
					<li><a href="/user/packages">View All Classes</a></li>
					<li><a href="/user/subjects">View All Subjects</a></li>
				</ul>
			</div>
		</div>
	</div>

	@if(Auth::user()->group_id == 2)
	<div class="col-sm-6">
	    <div class="panel panel-success">
	        <div class="panel-heading">
	            <h4>E-learning Menu</h4>
	        </div>
	        <div class="panel-body">
	            <p>&raquo; <a href="/educators/packages/">Manage Classes</a></p>
	            <p>&raquo; <a href="/educators/subjects/">Manage Subjects</a></p>
	            <p>&raquo; <a href="/educators/lessons/">Manage Lessons</a></p>
	            <p>&raquo; <a href="/educators/topics/">Manage Topics</a></p>
	            <p>&raquo; <a href="/user/images">Manage Images</a></p>
	        </div>
	    </div>
	</div>
	@else
	<div class="col-sm-6">
	    <div class="panel panel-success">
	        <div class="panel-heading">
	            <h4>Your Lessons</h4>
	        </div>
	        <div class="panel-body">
	           @if(count($enrolments) > 0)
	           		<p><b>You enrolled in {{$enrolments->count()}} lesson(s).</b></p>
	           		<hr>
	           		@foreach($enrolments as $enrolment)
	           			&raquo; {{$enrolment->lesson->package->name}}: {{$enrolment->lesson->subject->name}}: <b><a href="/user/lessons/{{$enrolment->lesson->id}}">{{$enrolment->lesson->name}}</a></b> <br>
	           		@endforeach
	           @else
	        		<p>You have not enrolled in any lesson.</p>
	           @endif
	        </div>
	    </div>
	</div>
    @endif

</div>

	@if(count($lessons) > 0)
		<h2>Recently Released Lessons</h2>
		<hr>
		@foreach($lessons as $lesson)
			<div class="well">
				<small>Class: <a href="/user/lessons/?package={{$lesson->package->id}}">{{$lesson->package->name}}</a></small><br>
				<small>Subject: <a href="/user/lessons/?subject={{$lesson->subject->id}}"> {{$lesson->subject->name}}</a></small><br>
				<small>Educator: {{$lesson->user->username}}</small>
				<h3>{{$lesson->name}}</h3>
				<p>{!! $lesson->description !!}</p>
				<p><a href="/user/lessons/{{$lesson->id}}">View Details</a></p>
			</div>
		@endforeach

		{{$lessons->links()}}
	@endif
	

@endsection