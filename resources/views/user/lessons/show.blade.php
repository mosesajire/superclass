@extends('layouts.app')

@section('title', '')

@section('content')
	{{-- Breadcrumb	 starts --}}
	<p class="breadcrumb"><a href="/user/lessons/?package={{$lesson->package->id}}">{{$lesson->package->name}}</a> > <a href="/user/lessons/?subject={{$lesson->subject->id}}">{{$lesson->subject->name}}</a></p>
	{{-- Breadcrumb	 starts --}}

	<h2>Class: {{$lesson->package->name}} | Subject: {{$lesson->subject->name}}</h2>
	<hr>
	<div class="well">
		<h3>{{$lesson->name}}</h3>
		<p>{!! $lesson->description !!}</p>
		<p>
		@if(isset($enrolment))
		<a href="/user/topics/?lesson={{$lesson->id}}">Go to Topics</a>
		@else
		<form action="{{action('User\EnrolmentsController@store')}}" class="form" method="POST">
			<input type="hidden" name="user_id" value="{{Auth::user()->id}}">

			<input type="hidden" name="lesson_id" value="{{$lesson->id}}">

			<input type="hidden" name="status" value="1">

			<input type="hidden" name="_token" value="{{csrf_token()}}">
			<input type="hidden" name="_method" value="POST">
			<div class="form-group">
				<button type="submit" class="btn btn-primary" onclick="return confirm('You are about to start learning the lesson. Click OK to continue.')">Start Learning</button>
			</div>
		</form>
		@endif
		</p>
	</div>
@endsection