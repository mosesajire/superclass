@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
    <p><a href="/admin/users/{{$user->id}}" class="btn btn-primary">Back</a></p>
    <div class="well">
        <legend>Edit User</legend>
        <form action="{!! action('Admin\UsersController@update', $user->id) !!}" class="form" method="post">
        {!! csrf_field() !!}
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

            <div class="form-group">
                <label for="role" class="control-label">Role</label>
                <select name="role_id" id="role" class="form-control">
                    <option value="">--Select Role--</option>
                    @if(count($roles) > 0)
                        @foreach($roles as $role)
                            <option value="{{$role->id}}" @if($role->id == $user->role_id) {{"selected=selected"}} @endif>{{$role->name}}</option>
                        @endforeach
                    @endif
                </select>
            </div>

            <div class="form-group">
                <label for="group">Group</label>
                <select name="group_id" id="group" class="form-control">
                    <option value="">--Select Group--</option>
                    @if(count($groups) > 0)
                        @foreach($groups as $group)
                            <option value="{{$group->id}}" @if($group->id == $user->group_id) {{"selected=selected"}} @endif>{{$group->name}}</option>
                        @endforeach
                    @endif
                </select>
            </div>

            <div class="form-group">
                <label for="status" class="control-label">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="">--Select Status--</option>
                    <option value="1" @if($user->status == 1) {{"selected=selected"}} @endif>Active</option>
                    <option value="2" @if($user->status == 2) {{"selected=selected"}} @endif>Inactive</option>
                </select>
            </div>


            <input type="hidden" name="_method" value="PUT">

            <div class="form-group">
                <button type="reset" class="btn btn-default">Cancel</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>

@endsection