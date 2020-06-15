@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading"><h4>Admin Menu</h4></div>

                <div class="panel-body">
                    <p>&raquo; <a href="/admin/profile">Manage Your Profile</a></p>
                    <p>&raquo; <a href="/admin/roles">Manage Roles</a></p>
                    <p>&raquo; <a href="/admin/categories">Manage Categories</a></p>
                    <p>&raquo; <a href="/admin/posts">Manage Posts</a></p>
                    <p>&raquo; <a href="/admin/images">Manage Images</a></p>
                    <p>&raquo; <a href="/admin/users">Manage Users</a></p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
             <div class="panel panel-success">
                <div class="panel-heading">
                    <h4>E-learning Portal</h4>
                </div>
                <div class="panel-body">
                    <p>&raquo; <a href="/educators/packages/">Manage Classes</a></p>
                    <p>&raquo; <a href="/educators/subjects/">Manage Subjects</a></p>
                    <p>&raquo; <a href="/educators/lessons/">Manage Lessons</a></p>
                    <p>&raquo; <a href="/educators/topics/">Manage Topics</a></p>
                    <p>&raquo; <a href="/educators/enrolments/">Manage Enrolments</a></p>
                    @if(Auth::user()->role_id == 1)
                        <p>&raquo; <a href="/user/images">Manage Images</a></p>
                    @endif

                    @if(Auth::user()->role_id == 2)
                        <p>&raquo; <a href="/admin/images">Manage Images</a></p>
                    @endif

                </div>
            </div>
        </div>

    </div>
@endsection
