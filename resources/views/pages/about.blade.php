@extends('layouts.app')

@section('title', 'SuperClass- Create Free Online Lessons for Students')

@section('content')
	@if($post)
	<div class="jumbotron text-center">
		<h2>{{$post->title}}</h2>
		<hr>
		<h3 style="line-height: 1.8">
			{!! $post->body !!}
		</h3>
	</div>
	@endif

@endsection
