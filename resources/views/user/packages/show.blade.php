@extends('layouts.app')

@section('title', '')

@section('content')

	@if($package)
		{{-- Breadcrumb	 starts --}}
		<p class="breadcrumb"><a href="/user/packages">All Classes</a></p>
		{{-- Breadcrumb	 starts --}}

		<h2>Class Details</h2>
		<hr>
			<div class="well">
				<h3>{{$package->name}}</h3>
				<p>{!! $package->description !!}</p>
				<p>{{$package->lesson->count()}} Lesson(s) | <a href="/user/lessons/?package={{$package->id}}">Go To Lessons</a></p>
			</div>
	@else
		<p>Sorry, something went wrong. CLass not found.</p>
	@endif

@endsection