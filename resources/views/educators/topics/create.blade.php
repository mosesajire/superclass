@extends('layouts.app')

@section('title', 'Create Topic')

@section('content')

	<p><a href="/educators/topics" class="btn btn-default">View All Topics</a></p>

	<div class="well">
		<legend>Create New Topic</legend>
		<form action="{{action('Educator\TopicsController@store')}}" class="form" method="POST" enctype="multipart/form-data">

			<div class="form-group">
				<label for="lesson">Lesson</label>
				<select name="lesson_id" id="lesson" class="form-control">
				<option value="">---Select Lesson---</option>
					@if(count($lessons) > 0)
						@foreach($lessons as $lesson)
							<option value="{{$lesson->id}}" @if(isset($_GET['lesson']) && $_GET['lesson'] == $lesson->id) selected="selected" @endif>{{$lesson->name}}</option>
						@endforeach
					@else
						<option value="0">No Lesson</option>
					@endif
				</select>
			</div>

			<div class="form-group">
				<label for="title">Title</label>
				<input type="text" name="title" id="title" class="form-control" value="{{old('title')}}">
			</div>

			<div class="form-group">
				<label for="body">Body</label>
				<textarea name="body" id="article-ckeditor" cols="30" rows="5" class="form-control">{{old('body')}}</textarea>
			</div>

			<div class="form-group">
				<label for="status">Status: </label>
				<select name="status" id="status">
					<option value="">--Select Status--</option>
					<option value="1">Publish</option>
					<option value="0">Unpublish</option>
				</select>
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