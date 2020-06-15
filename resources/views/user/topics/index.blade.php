@extends('layouts.app')

@section('title', 'All Topics')

@section('content')

	@if($enrolment)
		@if(count($topics) > 0)

			{{-- Breadcrumb	 starts --}}
			<p class="breadcrumb"><a href="/user/lessons/?package={{$lesson->package->id}}">{{$lesson->package->name}}</a> > <a href="/user/lessons/?subject={{$lesson->subject->id}}">{{$lesson->subject->name}}</a> > <a href="/user/lessons/{{$lesson->id}}">{{$lesson->name}}</a></p>
			{{-- Breadcrumb	 starts --}}

			<h2>{{$lesson->name}}: Currently Available Topics</h2>
			<hr>
			@foreach($topics as $topic)
				<div class="well">
					<h3>{{$topic->title}}</h3>
					<p>{!! $topic->body !!}</p>
					<p><a href="/user/topics/{{$topic->id}}/?lesson={{$lesson->id}}">View Details</a></p>
				</div>
			@endforeach

			{{$topics->links()}}
		@else
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3>Notification</h3>
				</div>
				<div class="panel-body">
					<p>There is no topic yet. <a href="/user/packages">View All Classes</a> </p>
				</div>
			</div>
		@endif
	@else
		<p>Sorry, you have not enrolled in the lesson. <a href="/user/packages">View All Classes</a> |  <a href="/user/subjects">View Available Subjects</a> </p>
	@endif
@endsection