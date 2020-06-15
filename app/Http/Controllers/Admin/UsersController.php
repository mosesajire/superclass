<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Requests\UserFormRequest;

use App\Http\Requests\UserEditFormRequest;

use App\Http\Controllers\Controller;

use App\User;

use App\Role;

use App\Group;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $groups = Group::all();

        $roles = Role::all();

        return view('admin.users.create', compact('groups', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserFormRequest $request)
    {
        $user = new User;

        $user->first_name = $request->get('first_name');
        $user->last_name = $request->get('last_name');
        $user->email = $request->get('email');
        $user->username = $request->get('username');
        $user->password = bcrypt($request->get('password'));
        $user->role_id = $request->get('role_id');
        $user->status = $request->get('status');
        $user->group_id = $request->get('group_id');

        $user->save();

        return redirect('/admin/users')->with('success', 'You have created a new user successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(User::find($id))
        {
            $user = User::find($id);

            return view('admin.users.show')->with('user', $user);
        }
        else
        {
            return redirect('/admin/users')->with('error', 'Sorry, something went wrong. User not found.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(User::find($id))
        {
            $user = User::find($id);

            $roles = Role::all();

            $groups = Group::all();

            return view('admin.users.edit', compact('user', 'roles', 'groups'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserEditFormRequest $request, $id)
    {
        if(User::find($id))
        {
            $user = User::find($id);

            $getEmail = $request->get('email');

            // email
            if($user->email != $getEmail)
            {
                if(User::where('email', $getEmail)->count() == 1)
                {
                    return redirect('/admin/users/' . $id . '/edit')->with('error', 'Sorry, the email is already registered.');
                }
                else
                {
                    $user->email = $request->get('email');
                }
            }

            // Username
            $getUsername = $request->get('username');

            if($user->username != $getUsername)
            {
                if(User::where('username', $getUsername)->count() == 1)
                {
                    return redirect('/admin/users/' . $id . '/edit')->with('error', 'Sorry, the username is already registered.');
                }
                else
                {
                    $user->username = $request->get('username');
                }
            }

            $user->first_name = $request->get('first_name');
            $user->last_name = $request->get('last_name');
            $user->role_id = $request->get('role_id');
            $user->status = $request->get('status');
            $user->group_id = $request->get('group_id');

            if($request->get('password') !== "")
            {
                $user->password = bcrypt($request->password);
            }

            $user->save();

            return redirect('/admin/users/' . $id)->with('success', 'You have updated a user successfully.');

        }
        else
        {
            return redirect('/admin/users/')->with('error', 'Sorry, something went wrong. User not found.');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
