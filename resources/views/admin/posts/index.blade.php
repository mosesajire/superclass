@extends('layouts.app')

@section('title', '')

@section('content')
	<p><a href="/admin/posts/create" class="btn btn-primary">Create New Post</a> | <a href="/admin/posts/" class="btn btn-primary">View All Posts</a></p>
	@if(count($posts) > 0)
		<h2>
			{{$title}}
		</h2>
		@foreach ($posts as $post)
			<div class="well">
				<div class="row">

					@if($post->cover_image !== "noimage.jpg")
						<div class="col-md-4 col-sm-4">
								<img style="width: 150%; max-height: 1500px;" src="/public/cover_images/{{$post->cover_image}}">
						</div>

						<div class="col-md-8 col-sm-8">
							<small>Category: {{$post->category->name}}</small>
							<h1><a href="/admin/posts/{{$post->id}}">{{$post->title}}</a></h1>

							@if (strlen($post->body) > 150)
								<p>{!! substr(strip_tags($post->body), 0, 150) !!} ...<a href='/admin/posts/{{$post->id}}'>Read more</a></p>
							@else
								<p>{!! $post->body !!}</p>
							@endif

							<small>Written on {{$post->created_at}} by <a href="/admin/posts/?user={{$post->user_id}}&name={{$post->user->username}}">{{$post->user->username}}</a></small><br>
						</div>

					@else

						<div class="col-md-12 col-sm-12">
							<small>Category: {{$post->category->name}}</small>
							<h1><a href="/admin/posts/{{$post->id}}">{{$post->title}}</a></h1>

							@if (strlen($post->body) > 150)
								<p>{!! substr(strip_tags($post->body), 0, 150) !!} <a href='/admin/posts/{{$post->id}}'> ...Read more</a></p>
							@else
								<p>{!! $post->body !!}</p>
							@endif

							<small>Written on {{$post->created_at}} by <a href="/admin/posts/?user={{$post->user_id}}&name={{$post->user->username}}">{{$post->user->username}}</a></small><br>


						</div>

					@endif

				</div>

			</div>
		@endforeach

		{{$posts->links()}}

	@else
		<p>No Post Found</p>
	@endif
@endsection