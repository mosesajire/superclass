@extends('layouts.app')

@section('title', '')

@section('content')

	@if($enrolment)

		{{-- Breadcrumb	 starts --}}
			<p class="breadcrumb"><a href="/user/lessons/?package={{$lesson->package->id}}">{{$lesson->package->name}}</a> > <a href="/user/lessons/?subject={{$lesson->subject->id}}">{{$lesson->subject->name}}</a> > <a href="/user/lessons/{{$lesson->id}}">{{$lesson->name}}</a> > <a href="/user/topics/?lesson={{$lesson->id}}">All Topics</a></p>
		{{-- Breadcrumb	 starts --}}

		<h2>Lesson: {{$lesson->name}}</h2>
		<hr>
		<div class="well">
			<h3>{{$topic->title}}</h3>
			<p>{!! $topic->body !!}</p>
		</div>
	@else
		<p>Sorry, you have not enrolled in the lesson. <a href="/user/subjects">View Available Subjects</a></p>
	@endif
@endsection