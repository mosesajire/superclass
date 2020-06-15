<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Controllers\Controller;

use App\Subject;

use App\Enrolment;

use App\Lesson;

use App\Package;

class LessonsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(isset($_GET['subject']) && !empty($_GET['subject']))
        {
            $user_id = auth()->user()->id;

            $subject_id = urlencode($_GET['subject']);

            $subject = Subject::where('id', $subject_id)->where('status', 1)->first();

            $lessons = Lesson::where('subject_id', $subject_id)->where('status', 1)->orderBy('id', 'desc')->paginate(10)->appends(request()->query());

            return view('user.lessons.index', compact('lessons', 'subject'));

        }
        elseif(isset($_GET['package']) && !empty($_GET['package']))
        {
            $user_id = auth()->user()->id;

            $package_id = urlencode($_GET['package']);

            $package = Package::where('id', $package_id)->where('status', 1)->first();

            $lessons = Lesson::where('package_id', $package_id)->where('status', 1)->orderBy('id', 'desc')->paginate(10)->appends(request()->query());

            return view('user.lessons.index', compact('lessons', 'package'));
        }
        else
        {
            return redirect()->back()->with('error', 'Sorry, something went wrong. Please try again.');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Lesson::find($id))
        {
            $lesson = Lesson::where('id', $id)->where('status', 1)->first();

            $lesson_id = $id;

            $user_id = auth()->user()->id;

            $subject_id = $lesson->subject->id;

            $subject = Subject::where('id', $subject_id)->where('status', 1)->first();

            $title = $lesson->name;

            $enrolment = Enrolment::where('lesson_id', $lesson_id)->where('user_id', $user_id)->where('status', 1)->first();

            return view('user.lessons.show', compact('enrolment', 'lesson', 'subject', 'title'));

        }
        else
        {
            return redirect('/user/subjects')->with('error', 'Sorry, something went wrong. Please try again.');
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
