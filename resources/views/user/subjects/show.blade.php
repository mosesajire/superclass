@extends('layouts.app')

@section('title', '')

@section('content')

	@if($subject)
		{{-- Breadcrumb	 starts --}}
		<p class="breadcrumb"><a href="/user/subjects">All Subjects</a></p>
		{{-- Breadcrumb	 starts --}}

		<h2>Subject Details</h2>
		<hr>
			<div class="well">
				<h3>{{$subject->name}}</h3>
				<p>{!! $subject->description !!}</p>
				<p>{{$subject->lesson->count()}} Lesson(s) | <a href="/user/lessons/?subject={{$subject->id}}">Go To Lessons</a></p>
			</div>
	@else
		<p>Sorry, something went wrong. Subject not found.</p>
	@endif

@endsection