<?php

namespace App\Http\Controllers\Educator;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Requests\TopicFormRequest;

use App\Http\Controllers\Controller;

use App\Topic;

use App\User;

use App\Lesson;

class TopicsController extends Controller
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
            $user_id = auth()->user()->id;

            // Show lessons of a particular course
            if(isset($_GET['lesson']) && !empty($_GET['lesson']))
            {

                $lesson_id = urlencode($_GET['lesson']);

                $get_lesson = Lesson::where('id', $lesson_id)->first();

                // Show all topics to admin
                if(auth()->user()->role_id == 2)
                {
                    $topics = Topic::where('lesson_id', $lesson_id)->orderBy('id', 'asc')->paginate(10)->appends(request()->query());
                }
                else
                {
                    $topics = Topic::where('lesson_id', $lesson_id)->where('user_id', $user_id)->orderBy('id', 'asc')->paginate(10)->appends(request()->query());
                }

                return view('educators.topics.index', compact('topics', 'get_lesson'));
            }
            else
            {
                // show all topics to admin
                if(auth()->user()->role_id == 2)
                {
                    $topics = Topic::orderBy('id', 'asc')->paginate(10);
                }
                else
                {
                    $topics = Topic::orderBy('id', 'asc')->where('user_id', $user_id)->paginate(10);
                }

                return view('educators.topics.index', compact('topics'));
            }
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
            $user_id = auth()->user()->id;

            $lessons = Lesson::where('user_id', $user_id)->get();

            return view('educators.topics.create')->with('lessons', $lessons);
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
    public function store(TopicFormRequest $request)
    {
        // Educator: group_id = 2

        if(auth()->user()->group_id == 2)
        {

            $topic = new Topic;

            $topic->lesson_id = $request->input('lesson_id');
            $topic->title = $request->input('title');
            $topic->body = $request->input('body');
            $topic->user_id = $request->input('user_id');
            $topic->status = $request->input('status');
            $topic->save();

            return redirect()->back()->with('success', 'You have created a new lesson successfully.');
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
        // Educator: group_id = 2

        if(auth()->user()->group_id == 2)
        {
            if(Topic::find($id))
            {
                $topic = Topic::find($id);

                return view('educators.topics.show')->with('topic', $topic);
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

            if(Topic::find($id))
            {

                $lessons = Lesson::all();

                $topic = Topic::find($id);

                return view('educators.topics.edit', compact('lessons', 'topic'));
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
    public function update(Request $request, $id)
    {
        // Educator: group_id = 2

        if(auth()->user()->group_id == 2)
        {
            if(Topic::find($id))
            {
                $topic = Topic::find($id);

                $topic->lesson_id = $request->input('lesson_id');
                $topic->title = $request->input('title');
                $topic->body = $request->input('body');
                $topic->status = $request->input('status');

                $topic->save();

                return redirect()->back()->with('success', 'You have updated a topic successfully.');
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
