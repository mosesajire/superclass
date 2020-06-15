@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
    <p><a href="/admin/profile/" class="btn btn-primary">Back</a></p>
    <div class="well">
        <legend>Edit Your Profile</legend>
        <form action="{!! action('Admin\ProfilesController@update', $user->id) !!}" class="form" method="post" enctype="multipart/form-data">
        {!! csrf_field() !!}

        <div class="form-group">
            @if($user->picture == 'noimage.jpg' || $user->picture == '')
                <label for="picture" class="control-label">Upload Profile Picture</label>
                 <br><img style="width: 150px; height: 150px;" src="/public/profile_pictures/noimage.jpg">
            @else
                <label for="picture" class="control-label">Select Action</label>
                <select name="picture_action">
                    <option value="retain">Retain Picture</option>
                    <option value="change">Change Picture</option>
                    <option value="delete">Remove Picture</option>
                </select>
                <br><img style="width: 150px; height: 150px;" src="/public/profile_pictures/{{$user->picture}}">
            @endif

            <input type="file" name="picture">
        </div>

            <div class="form-group">
                <label for="first_name" class="control-label">First Name</label>
                <input type="text" class="form-control" name="first_name" id="first_name" value="{{$user->first_name}}">
            </div>

            <div class="form-group">
                <label for="last_name" class="control-label">Last Name</label>
                <input type="text" class="form-control" name="last_name" id="last_name" value="{{$user->last_name}}">
            </div>

            <div class="form-group">
                <label for="username" class="control-label">Username</label>
                <input type="text" class="form-control" name="username" id="username" value="{{$user->username}}">
            </div>


            <div class="form-group">
                <label for="email" class="control-label">Email</label>
                <input type="text" class="form-control" name="email" id="email" value="{{$user->email}}">
            </div>

            <div class="form-group">
                <label for="password" class="control-label">Password</label>
                <input type="password" class="form-control" name="password" id="password">
            </div>

            <div class="form-group">
                <label for="password_confirmation" class="control-label">Confirm Password</label>
                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
            </div>

            <input type="hidden" name="_method" value="PUT">

            <div class="form-group">
                <button type="reset" class="btn btn-default">Cancel</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>

@endsection