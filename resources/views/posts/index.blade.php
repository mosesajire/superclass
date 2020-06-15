@extends('layouts.app')

@section('title', 'All Posts')

@section('content')

	@if(count($posts) > 0)

		@foreach ($posts as $post)
			<div class="well">
				<div class="row">

					@if($post->cover_image !== "noimage.jpg")
						<div class="col-md-4 col-sm-4">
								<img style="width: 100%; max-height: 250px;" src="/public/cover_images/{{$post->cover_image}}">
						</div>

						<div class="col-md-8 col-sm-8">
							<small>Category: {{$post->category->name}}</small>
							<h1><a href="/posts/{{$post->id}}">{{$post->title}}</a></h1>

							@if (strlen($post->body) > 100)
								<p>{!! substr(strip_tags($post->body), 0, 100) !!} ...<a href='/posts/{{$post->id}}'>Read more</a></p>
							@else
								<p>{!! $post->body !!}</p>
							@endif

							<small>Written on {{$post->created_at}} by {{$post->user->first_name}}</small><br>
						</div>

					@else

						<div class="col-md-12 col-sm-12">
							<small>Category: {{$post->category->name}}</small>
							<h1><a href="/posts/{{$post->id}}">{{$post->title}}</a></h1>

							@if (strlen($post->body) > 100)
								<p>{!! substr(strip_tags($post->body), 0, 100) !!} <a href='/posts/{{$post->id}}'> ...Read more</a></p>
							@else
								<p>{!! $post->body !!}</p>
							@endif

							<small>Written on {{$post->created_at}} by {{$post->user->first_name}}</small>


						</div>

					@endif
<?php
/*
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
							<div class="comment-form">
								<a href="#{{$post->id}}">Post a Comment</a>
								<div class="comment hide">
									<form action="{{action('User\CommentsController@store')}}" method="POST" class="well">
										<div class="form-group">
											<label for="content" class="control-label">Your Comment</label>
											<textarea name="content" id="content" cols="30" rows="4" class="form-control">{{old('content')}}</textarea>
										</div>
										<input type="hidden" name="_token" value="{{csrf_token()}}">
										<input type="hidden" name="_method" value="POST">
										<input type="hidden" name="post_id" value="{{$post->id}}">
										<input type="hidden" name="user_id" value="{{Auth::user()->id}}">
										<input type="hidden" name="status" value="1">
										<input type="reset" name="reset" value="CANCEL" class="btn btn-default">
										<input type="submit" name="submit" value="SUBMIT" class="btn btn-primary">
									</form>
								</div>

							</div>

						@endif

					@else
						<div class="col-lg-12">
							<p>&nbsp;</p>
							<p>Please <a href="/login">Login</a> to comment on this post.</p>
						</div>
					@endif
*/
?>

				</div>

			</div>
		@endforeach

		{{$posts->links()}}

	@else
		<p>No Post Found</p>
	@endif
@endsection