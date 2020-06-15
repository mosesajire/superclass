@extends('layouts.app')

@section('title', 'All Classes')

@section('content')

	@if(count($packages) > 0)

		<h2>All Classes</h2>
		<hr>
		<div class="myClass">
		@foreach($packages as $package)
		<div class="myClass-item">
			<h3>{{$package->name}}</h3>
			<p>{!! $package->description !!}</p>
			<p>{{$package->lesson->count()}} Lesson(s) | <a href="/user/packages/{{$package->id}}">View Details</a></p>
		</div>
		@endforeach
		</div>

		{{$packages->links()}}
	@else
		<p>There is no class yet.</p>
	@endif

@endsection