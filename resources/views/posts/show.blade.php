@extends('layouts.app')

@section('title', 'Post')

@section('content')
	<a href="/posts" class="btn btn-default">Go Back</a>
	<div class="well">
		<p>Category: {{$post->category->name}}</p>
		<h1>{{$post->title}}</h1>
		@if($post->cover_image !== "noimage.jpg")
			<img style="width: 100%; max-height: 300px;" src="/public/cover_images/{{$post->cover_image}}">
		@endif
		<p>{!!$post->body!!}</p>
		<small>Written on {{$post->created_at}} by {{$post->user->first_name}}</small>
	</div>
	<hr>
	{{-- Only display links to registered users. --}}

	@if(!Auth::guest())

		@if(Auth::user()->id == $post->user_id)

			<a href="/user/posts/{{$post->id}}/edit" class="btn btn-default pull-left add-margin">Edit</a>
			<form action="{{action('User\PostsController@destroy', $post->id)}}" class="form add-margin pull-left" method="POST">
				<input type="hidden" name="_method" value="DELETE">
				<input type="hidden" name="_token" value="{{csrf_token()}}">
				<input type="submit" name="submit" value="Delete" class="btn btn-danger" onclick="return confirm('You have chosen to delete an item. Click OK to continue.')">
			</form>
			<div class="clearfix"></div>

		@endif

	@endif

	{{-- Show comments here --}}
	@if($post->comment->count() > 0)
		<p>&nbsp;&nbsp;&nbsp;&raquo; {{$post->comment->count()}} Comment(s)</p>
		@foreach($post->comment as $comment)
			<p>{{$comment->user->first_name}} on {{$comment->created_at}}: {{$comment->content}}</p>

			@if((!(Auth::guest())) && ($comment->user_id == Auth::user()->id))
				<a href="/posts/{{$post->id}}/?comment={{$comment->id}}" class="btn btn-default pull-left add-margin">Edit</a>
				<form action="{{action('User\CommentsController@destroy', $comment->id)}}" class="form add-margin pull-left" method="POST">
					<input type="hidden" name="_method" value="DELETE">
					<input type="hidden" name="_token" value="{{csrf_token()}}">
					<input type="submit" name="submit" value="Delete" class="btn btn-danger" onclick="return confirm('You have chosen to delete a comment. Click OK to continue.')">
				</form>
				<div class="clearfix"></div>

				{{-- Display this to show comment edit form--}}
				@if(isset($_GET['comment']) && $_GET['comment'] == $comment->id)

				<form action="{{action('User\CommentsController@update', $comment->id)}}" method="POST" class="well">
					<div class="form-group">
						<label for="content" class="control-label">Edit Your Comment</label>
						<textarea name="content" id="content" cols="30" rows="5" class="form-control">{{$comment->content}}</textarea>
					</div>
					<input type="hidden" name="_token" value="{{csrf_token()}}">
					<input type="hidden" name="_method" value="PUT">
					<input type="hidden" name="post_id" value="{{$post->id}}">
					<input type="hidden" name="user_id" value="{{Auth::user()->id}}">
					<input type="hidden" name="status" value="1">
					<input type="reset" name="reset" value="CANCEL" class="btn btn-default">
					<input type="submit" name="submit" value="SUBMIT" class="btn btn-primary">
				</form>

				@endif

			@endif

		@endforeach
	@else
		<p>&nbsp;&nbsp;&nbsp;&raquo; No Comment Yet. Be the first to post a comment.</p>
	@endif

	{{-- Comments Section: Remove if comments are not needed. --}}
	@if(!(Auth::guest()))
		@if(!(isset($_GET['comment'])))
			{{-- Display this to show comment form--}}
			<form action="{{action('User\CommentsController@store')}}" method="POST" class="well">
				<div class="form-group">
					<label for="content" class="control-label">Your Comment</label>
					<textarea name="content" id="content" cols="30" rows="5" class="form-control">{{old('content')}}</textarea>
				</div>
				<input type="hidden" name="_token" value="{{csrf_token()}}">
				<input type="hidden" name="_method" value="POST">
				<input type="hidden" name="post_id" value="{{$post->id}}">
				<input type="hidden" name="user_id" value="{{Auth::user()->id}}">
				<input type="hidden" name="status" value="1">
				<input type="reset" name="reset" value="CANCEL" class="btn btn-default">
				<input type="submit" name="submit" value="SUBMIT" class="btn btn-primary">
			</form>
		@endif

	@else
		<div class="col-lg-12">
			<p>&nbsp;</p>
			<p>Please <a href="/login">Login</a> to comment on this post.</p>
		</div>
	@endif
@endsection