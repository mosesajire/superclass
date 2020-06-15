<?php

namespace App\Http\Controllers\Educator;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Requests\ParticipantFormRequest;

use App\Http\Controllers\Controller;

use App\Participant;

use App\User;

use App\Course;

class ParticipantsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // Educator: group_id = 2

        if(auth()->user()->group_id == 2)
        {
            $participants = Participant::orderBy('id', 'asc')->paginate(10);

            return view('educators.participants.index')->with('participants', $participants);
        }
        else
        {
            return redirect('/')->with('error', 'Something went wrong. Access denied.');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Educator: group_id = 2

        if(auth()->user()->group_id == 2)
        {
            $users = User::all();

            $courses = Course::all();

            return view('educators.participants.create', compact('users', 'courses'));
        }
        else
        {
            return redirect('/')->with('error', 'Something went wrong. Access denied.');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ParticipantFormRequest $request)
    {
        // Educator: group_id = 2

        if(auth()->user()->group_id == 2)
        {

            $user_id = $request->input('user_id');
            $course_id = $request->input('course_id');

            if(Participant::where('user_id', $user_id)->where('course_id', $course_id)->count() == 0)
            {
                $participant = new Participant;

                $participant->user_id = $request->input('user_id');
                $participant->course_id = $request->input('course_id');
                $participant->status = $request->input('status');

                $participant->save();

                return redirect()->back()->with('success', 'You have created a new participant successfully.');
            }
            else
            {
                return redirect()->back()->with('error', 'Sorry, the specified user is already a participant in the specified course');
            }


        }
        else
        {
            return redirect('/')->with('error', 'Something went wrong. Access denied.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Educator
        if(auth()->user()->group_id == 2)
        {

            if(Participant::find($id))
            {
                $users = User::all();

                $courses = Course::all();

                $participant = Participant::find($id);

                return view('educators.participants.edit', compact('participant', 'users', 'courses'));
            }
            else
            {
                return redirect('/')->with('error', 'Something went wrong. Topic not found.');
            }

        }
        else
        {
            return redirect('/')->with('error', 'Something went wrong. Access denied.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ParticipantFormRequest $request, $id)
    {
        // Educator: group_id = 2

        if(auth()->user()->group_id == 2)
        {
            if(Participant::find($id))
            {
                $participant = Participant::find($id);

                $participant->user_id = $request->input('user_id');
                $participant->course_id = $request->input('course_id');
                $participant->status = $request->input('status');

                $participant->save();

                return redirect()->back()->with('success', 'You have updated a participant successfully.');
            }
            else
            {
                return redirect('/')->with('error', 'Something went wrong. Participant not found.');
            }

        }
        else
        {
            return redirect('/')->with('error', 'Something went wrong. Access denied.');
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
