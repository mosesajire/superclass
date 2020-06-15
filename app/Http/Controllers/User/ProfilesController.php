<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

use App\Http\Requests;

// use Illuminate\Support\Facades\File;

use App\Http\Requests\ProfileFormRequest;

use App\Http\Controllers\Controller;

use App\User;

class ProfilesController extends Controller
{
    public function index() {
        $user_id = auth()->user()->id;

        return redirect('/user/profile/' . $user_id);
    }

    public function show($id)
    {
        if(User::find($id))
        {
            if(auth()->user()->id == $id)
            {
                $user = User::find($id);

                return view('user.profile.show')->with('user', $user);

            }
            else
            {
                return redirect('/user/dashboard')->with('error', 'Sorry, something went wrong. Access denied!');
            }
        }
        else
        {
            return redirect('/user/dashboard')->with('error', 'Sorry, something went wrong. Please try again.');
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
            if(auth()->user()->id == $id)
            {
                $user = User::find($id);

                return view('user.profile.edit')->with('user', $user);

            }
            else
            {
                return redirect('/user/dashboard')->with('error', 'Sorry, something went wrong. Access denied!');
            }
        }
        else
        {
            return redirect('/user/dashboard')->with('error', 'Sorry, something went wrong. Please try again.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileFormRequest $request, $id)
    {
        if(User::find($id))
        {
            if(auth()->user()->id == $id)
            {

                // Handle file upload
                if($request->hasFile('picture')) {
                    // Get filename with extension
                    $fileNameWithExt = $request->file('picture')->getClientOriginalName();

                    // Get just file name
                    $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

                    // Get just extension
                    $extension = $request->file('picture')->getClientOriginalExtension();

                    // File name to store
                    $fileNameToStore = $filename . "_" . time() . '.' . $extension;

                    // Upload image
                    $path = $request->file('picture')->move('public/profile_pictures', $fileNameToStore);

                }

                // Get details of the user

                $user = User::find($id);


                if (($request->input('picture_action') == 'delete' && $request->hasFile('picture')) || ($request->input('picture_action') == 'change' && $request->hasFile('picture')) || ($request->input('picture_action') == 'delete' && !($request->hasFile('picture'))) || $request->hasFile('picture')) 
                {

                    if (($user->picture !== 'noimage.jpg') && ($user->picture !== ""))
                    {
                        $picture_path = public_path() . '/public/profile_pictures/' . $user->picture;

                        // Delete image
                        if (file_exists($picture_path))
                        {
                            unlink($picture_path);
                        }
                    }
                }

                // Add new image
                if($request->hasFile('picture')) 
                {
                    $user->picture = $fileNameToStore;
                }

                if ($request->input('picture_action') == 'delete' && !($request->hasFile('picture'))) {
                    $user->picture = 'noimage.jpg';
                }

                $getEmail = $request->get('email');

                if($user->email != $getEmail)
                {
                    if(User::where('email', $getEmail)->count() == 1)
                    {
                        return redirect()->back()->with('error', 'Sorry, the email is already registered.');
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
                        return redirect()->back()->with('error', 'Sorry, the username is already registered.');
                    }
                    else
                    {
                        $user->username = $request->get('username');
                    }
                }

                $user->first_name = $request->get('first_name');
                $user->last_name = $request->get('last_name');

                if($request->get('password') !== "")
                {
                    $user->password = bcrypt($request->password);
                }

                $user->save();

                return redirect('/user/profile/' . $id)->with('success', 'You have updated a user successfully.');

            }
            else
            {
                return redirect('/user/dashboard')->with('error', 'Sorry, something went wrong. Access denied!');
            }

        }
        else
        {
            return redirect('/user/dashboard/')->with('error', 'Sorry, something went wrong. Please try again.');
        }
    }
}
