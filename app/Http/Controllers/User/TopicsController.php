<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Controllers\Controller;

use App\Subject;

use App\Enrolment;

use App\Lesson;

use App\Topic;

class TopicsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(isset($_GET['lesson']) && !empty($_GET['lesson']))
        {
            $user_id = auth()->user()->id;

            $lesson_id = urlencode($_GET['lesson']);

            $lesson = Lesson::where('id', $lesson_id)->where('status', 1)->first();

            $subject_id = $lesson->subject->id;

            $topics = Topic::where('lesson_id', $lesson_id)->where('status', 1)->orderBy('id', 'desc')->paginate(5)->appends(request()->query());

            $enrolment = Enrolment::where('lesson_id', $lesson_id)->where('user_id', $user_id)->where('status', 1)->first();

            return view('user.topics.index', compact('enrolment', 'topics', 'lesson'));

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
        if(Topic::find($id))
        {
            $topic = Topic::where('id', $id)->where('status', 1)->first();

            $user_id = auth()->user()->id;

            $lesson_id = $topic->lesson->id;

            $lesson = Lesson::where('id', $lesson_id)->where('status', 1)->first();

            $subject_id = $lesson->subject->id;

            $enrolment = Enrolment::where('lesson_id', $lesson_id)->where('user_id', $user_id)->where('status', 1)->first();

            $title = $topic->title;

            return view('user.topics.show', compact('enrolment', 'topic', 'lesson', 'title'));

        }

        else
        {
            return redirect()->back()->with('error', 'Sorry, something went wrong. Please try again.');
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
