@extends('layouts.app')

@section('title', 'All Subjects')

@section('content')

	@if(count($subjects) > 0)

		<h2>Currently Available Subjects</h2>
		<hr>
		<div class="mySubject">
		@foreach($subjects as $subject)
		<div class="mySubject-item">
			<h3>{{$subject->name}}</h3>
			<p>{!! $subject->description !!}</p>
			<p>{{$subject->lesson->count()}} Lesson(s) | <a href="/user/subjects/{{$subject->id}}">View Details</a></p>
		</div>
		@endforeach
		</div>

		{{$subjects->links()}}
	@else
		<p>There is no subject yet.</p>
	@endif

@endsection