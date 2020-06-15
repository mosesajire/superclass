@extends('layouts.app')

@section('title', 'All Lessons')

@section('content')

	@if(count($lessons) > 0)
		{{-- Breadcrumb	 starts --}}
		<p class="breadcrumb"><a href="/user/packages/">All Classes</a> </p>
		{{-- Breadcrumb	 starts --}}

		<h2>Currently Available Lessons</h2>
		<hr>
		<div class="row">
		@foreach($lessons as $lesson)
		<div class="col-md-12">
			<div class="well">
				<small>Class: <a href="/user/lessons/?package={{$lesson->package->id}}">{{$lesson->package->name}}</a></small><br>
				<small>Subject: <a href="/user/lessons/?subject={{$lesson->subject->id}}"> {{$lesson->subject->name}}</a></small><br>
				<small>Educator: {{$lesson->user->username}}</small>

				<h3>{{$lesson->name}}</h3>
				<p>{!! $lesson->description !!}</p>
				<p><a href="/user/lessons/{{$lesson->id}}/?subject={{$lesson->subject->id}}&package={{$lesson->package->id}}">View Details</a></p>
			</div>
		</div>
		@endforeach
		</div>

		{{$lessons->links()}}
	@else
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3>Notification</h3>
			</div>
			<div class="panel-body">
				<p>There is no lesson yet. <a href="/user/packages">View All Classes</a> </p>
			</div>
		</div>
	@endif
@endsection