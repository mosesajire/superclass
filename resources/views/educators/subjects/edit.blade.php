@extends('layouts.app')

@section('title', 'Edit Subject')

@section('content')

	<p><a href="/educators/subjects" class="btn btn-default">View All Subjects</a> | <a href="/educators/subjects/create" class="btn btn-primary">Create New Subject</a></p>

	@if($subject && Auth::user()->role_id == 2)

	<div class="well">
		<legend>Edit Subject</legend>
		<form action="{{action('Educator\SubjectsController@update', $subject->id)}}" class="form" method="POST" enctype="multipart/form-data">

			<div class="form-group">
				<label for="name">Name</label>
				<input type="text" name="name" id="name" class="form-control" value="{{$subject->name}}">
			</div>

			<div class="form-group">
				<label for="description">Description</label>
				<textarea name="description" id="article-ckeditor" cols="30" rows="5" class="form-control">{!! $subject->description !!}</textarea>
			</div>

			<div class="form-group">
                <label for="status" >Status: </label>
                <select name="status" id="status">
                    <option value="">--Select Status--</option>
                    <option value="1" @if($subject->status == 1) {{"selected=selected"}} @endif>Published</option>
                    <option value="0" @if($subject->status == 0) {{"selected=selected"}} @endif>Unpublished</option>
                </select>
            </div>

            <div class="form-group">
				@if($subject->subject_image == 'noimage.jpg' || $subject->subject_image == "")
					<label for="subject_image">Upload Subject Image</label>
				@else
					<label for="package_image">Image Action</label>
					<select name="image_action">
						<option value="retain">Retain Image</option>
						<option value="change">Change Image</option>
						<option value="delete">Delete Image</option>
					</select>
					<br><img style="width: 150px; height: 150px;" src="/public/subject_images/{{$subject->subject_image}}">
				@endif

				<input type="file" name="subject_image">
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