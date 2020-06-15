@extends('layouts.app')

@section('title', 'Free Online Lessons for Secondary School Students')

@section('content')
	@if($message)
	<div class="myMessage">
		<p>{!! $message->body !!}</p>
	</div>
	@endif

	@if($myIntro1)
	<div class="myIntro-box1">
		<h2>{{$myIntro1->title}}</h2>
		<p>{!! $myIntro1->body !!}</p>
		@if(Auth::guest())
			<a href="/register" class="btn btn-primary btn-lg">REGISTER NOW</a>
		@endif
	</div>
	@endif

	@if($myIntro2)
		@if(Auth::guest())
		<div class="myIntro-box2">
			<h2>{{$myIntro2->title}}</h2>
			<p>{!! $myIntro2->body !!}</p>
			<a href="/register" class="btn btn-default btn-lg">BECOME AN EDUCATOR</a>
		</div>
		@endif
	@endif

	@if(count($packages) > 0)

		<h2 class="text-success">Available Classes</h2>
		<hr>
		<div class="myClass">
		@foreach($packages as $package)
			<div class="myClass-item">
				<h3>{{$package->name}}</h3>
				<p>{!! $package->description !!}</p>
				<p><a href="/user/packages/{{$package->id}}">View Details</a> | {{$package->lesson->count()}} Lesson(s)</p>
			</div>
		@endforeach
		</div>

	{{--	{{$packages->links()}}  --}}
	@else
		<p>There is no package yet.</p>
	@endif


	@if(count($subjects) > 0)

		<h2 class="text-primary">Available Subjects</h2>
		<hr>
		<div class="mySubject">
		@foreach($subjects as $subject)
		<div class="mySubject-item">
			<div class="well1">
				<h3>{{$subject->name}}</h3>
				<p>{!! $subject->description !!}</p>
				<p><a href="/user/subjects/{{$subject->id}}">View Details</a> | {{$subject->lesson->count()}} Lesson(s) </p>
			</div>
		</div>
		@endforeach
		</div>
		<p><a href="/user/subjects" class="btn btn-primary btn-lg btn-block">SEE ALL SUBJECTS</a></p>
	{{-- 	{{$subjects->links()}}   --}}
	@else
		<p>There is no subject yet.</p>
	@endif

@endsection
