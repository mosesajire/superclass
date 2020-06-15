<?php

namespace App\Http\Controllers\Educator;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Requests\EnrolmentFormRequest;

use App\Http\Controllers\Controller;

use App\User;

use App\Enrolment;

use App\Lesson;

class EnrolmentsController extends Controller
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
            $enrolments = Enrolment::orderBy('id', 'asc')->paginate(10);

            return view('educators.enrolments.index')->with('enrolments', $enrolments);
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
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EnrolmentFormRequest $request)
    {
        // Educator: group_id = 2

        if(auth()->user()->group_id == 2)
        {

            $user_id = $request->input('user_id');
            $lesson_id = $request->input('lesson_id');

            if(Enrolment::where('user_id', $user_id)->where('lesson_id', $lesson_id)->count() == 0)
            {
                $enrolment = new Enrolment;

                $enrolment->user_id = $request->input('user_id');
               
                $enrolment->lesson_id = $request->input('lesson_id');

                $enrolment->status = $request->input('status');

                $enrolment->save();

                return redirect()->back()->with('success', 'You have created a new enrolment successfully.');
            }
            else
            {
                return redirect()->back()->with('error', 'Sorry, the specified user is already enrolled in the specified lesson');
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

            if(Enrolment::find($id))
            {
                $users = User::all();

                $lessons = Lesson::all();

                $enrolment = Enrolment::find($id);

                return view('educators.enrolments.edit', compact('enrolment', 'users', 'lessons'));
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
    public function update(EnrolmentFormRequest $request, $id)
    {
        // Educator: group_id = 2

        if(auth()->user()->group_id == 2)
        {
            if(Enrolment::find($id))
            {
                $enrolment = Enrolment::find($id);

                $enrolment->user_id = $request->input('user_id');

                $enrolment->lesson_id = $request->input('lesson_id');

                $enrolment->status = $request->input('status');

                $enrolment->save();

                return redirect()->back()->with('success', 'You have updated an enrolment successfully.');
            }
            else
            {
                return redirect('/')->with('error', 'Something went wrong. Enrolment not found.');
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
