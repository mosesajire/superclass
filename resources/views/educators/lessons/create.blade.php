@extends('layouts.app')

@section('title', 'Create Lesson')

@section('content')

	<p><a href="/educators/lessons" class="btn btn-default">View All Lessons</a></p>

	<div class="well">
		<legend>Create New Lesson</legend>
		<form action="{{action('Educator\LessonsController@store')}}" class="form" method="POST" enctype="multipart/form-data">

			<div class="form-group">
				<label for="package">Class</label>
				<select name="package_id" id="package" class="form-control">
				<option value="">---Select Class---</option>
					@if(count($packages) > 0)
						@foreach($packages as $package)
							<option value="{{$package->id}}" @if(isset($_GET['package']) && $_GET['package'] == $package->id) selected="selected" @endif>{{$package->name}}</option>
						@endforeach
					@else
						<option value="0">No Class</option>
					@endif
				</select>
			</div>

			<div class="form-group">
				<label for="subject">Subject</label>
				<select name="subject_id" id="subject" class="form-control">
				<option value="">---Select Subject---</option>
					@if(count($subjects) > 0)
						@foreach($subjects as $subject)
							<option value="{{$subject->id}}" @if(isset($_GET['subject']) && $_GET['subject'] == $subject->id) selected="selected" @endif>{{$subject->name}}</option>
						@endforeach
					@else
						<option value="0">No Subject</option>
					@endif
				</select>
			</div>

			<div class="form-group">
				<label for="name">Name</label>
				<input type="text" name="name" id="name" class="form-control" value="{{old('name')}}">
			</div>

			<div class="form-group">
				<label for="description">Description</label>
				<textarea name="description" id="article-ckeditor" cols="30" rows="5" class="form-control">{{old('description')}}</textarea>
			</div>

			<div class="form-group">
				<label for="status">Status: </label>
				<select name="status" id="status">
					<option value="">--Select Status--</option>
					<option value="1">Publish</option>
					<option value="0">Unpublish</option>
				</select>
			</div>

			<div class="form-group">
				<label for="lesson_image">Lesson Image</label>
				<input type="file" name="lesson_image">
			</div>

			<input type="hidden" name="user_id" value="{{Auth::user()->id}}">
			<input type="hidden" name="_token" value="{{csrf_token()}}">
			<input type="hidden" name="_method" value="POST">
			<div class="form-group">
				<button type="reset" class="btn btn-default">Cancel</button>
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</form>
	</div>

@endsection