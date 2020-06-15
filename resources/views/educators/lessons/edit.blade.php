@extends('layouts.app')

@section('title', 'Edit Lesson')

@section('content')

	<p><a href="/educators/lessons" class="btn btn-default">View All Lessons</a> | <a href="/educators/lessons/create" class="btn btn-primary">Create New Lesson</a></p>

	@if($lesson)

	<div class="well">
		<legend>Edit Lesson</legend>
		<form action="{{action('Educator\LessonsController@update', $lesson->id)}}" class="form" method="POST" enctype="multipart/form-data">

			<div class="form-group">
				<label for="package">Class</label>
				<select name="package_id" id="package" class="form-control">
				<option value="">---Select Class---</option>
					@if(count($packages) > 0)
						@foreach($packages as $package)
							<option value="{{$package->id}}" @if($lesson->package_id == $package->id) selected="selected" @endif>{{$package->name}}</option>
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
							<option value="{{$subject->id}}" @if($lesson->subject_id == $subject->id) selected="selected" @endif>{{$subject->name}}</option>
						@endforeach
					@else
						<option value="0">No Subject</option>
					@endif
				</select>
			</div>

			<div class="form-group">
				<label for="name">Name</label>
				<input type="text" name="name" id="name" class="form-control" value="{{$lesson->name}}">
			</div>

			<div class="form-group">
				<label for="description">Description</label>
				<textarea name="description" id="article-ckeditor" cols="30" rows="5" class="form-control">{!! $lesson->description !!}</textarea>
			</div>

			<div class="form-group">
                <label for="status" >Status: </label>
                <select name="status" id="status">
                    <option value="">--Select Status--</option>
                    <option value="1" @if($lesson->status == 1) {{"selected=selected"}} @endif>Published</option>
                    <option value="0" @if($lesson->status == 0) {{"selected=selected"}} @endif>Unpublished</option>
                </select>
            </div>

            <div class="form-group">
				@if($lesson->lesson_image == 'noimage.jpg')
					<label for="course_image">Upload Lesson Image</label>
				@else
					<label for="package_image">Image Action</label>
					<select name="image_action">
						<option value="retain">Retain Image</option>
						<option value="change">Change Image</option>
						<option value="delete">Delete Image</option>
					</select>
					<br><img style="width: 150px; height: 150px;" src="/public/lesson_images/{{$lesson->lesson_image}}">
				@endif

				<input type="file" name="lesson_image">
			</div>

			<input type="hidden" name="user_id" value="{{Auth::user()->id}}">
			<input type="hidden" name="_token" value="{{csrf_token()}}">
			<input type="hidden" name="_method" value="PUT">
			<div class="form-group">
				<button type="reset" class="btn btn-default">Cancel</button>
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</form>
	</div>
	@else
		<p>Sorry, something went wrong. Please try again.</p>
	@endif

@endsection