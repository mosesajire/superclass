@extends('layouts.app')

@section('title', 'All Images')

@section('content')
	<a href="/user/images/create" class="btn btn-primary">Upload New Image</a>
	@if(count($images) > 0)

		@foreach ($images as $image)
			<div class="well">
				<div class="row">

					@if($image->path !== "noimage.jpg")
						<div class="col-md-4 col-sm-4">
								<img style="width: 100%; max-height: 250px;" src="/public/cover_images/{{$image->path}}">
						</div>

						<div class="col-md-8 col-sm-8">
							<h4>Image URL: /public/cover_images/{{$image->path}}</h4>
							<h1><a href="/user/images/{{$image->id}}">{{$image->name}}</a></h1>

							<small>Uploaded on {{$image->created_at}} by {{$image->user->first_name}}</small><br>
						</div>

					@else

						<div class="col-md-12 col-sm-12">

							<h4>Image URL: /public/cover_images/{{$image->path}}</h4>
							<h1><a href="/user/images/{{$image->id}}">{{$image->name}}</a></h1>

							<small>Written on {{$image->created_at}} by {{$image->user->first_name}}</small><br>


						</div>

					@endif

				</div>

			</div>
		@endforeach

		{{$images->links()}}

	@else
		<p>No Image Found</p>
	@endif
@endsection