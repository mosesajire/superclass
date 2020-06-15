@extends('layouts.app')

@section('title', 'Page Not Found!')

@section('content')
	<div class="panel panel-danger text-center">
		<div class="panel-heading">
			<h1>Page Not Found!</h1>
		</div>
		<div class="panel-body">
			<h2>Sorry, something went wrong.</h2>
			<h3>We could not find the page you're looking for.</h3>
			<h3>Please click <a href="/">here</a> to go to the homepage.</h3>
			<h3>Thank you.</h3>
		</div>
	</div>

@endsection