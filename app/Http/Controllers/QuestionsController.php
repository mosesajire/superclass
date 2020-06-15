<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Requests\QuestionFormRequest;

use App\Http\Requests\QuestionUploadFormRequest;

use App\Question;

use App\User;

use App\Response;

use App\Student;



class QuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $user_id = auth()->user()->id;

       $student = Student::where('user_id', $user_id)->first();

       $score = Response::where('user_id', $user_id)->where('score', '1')->count();

       return view('exams.questions.index', compact('student', 'response', 'score'));
    }

    // Let participants take exam
    public function takeExam()
    {
        $questions = Question::orderBy('id', 'asc')->paginate(1);

        $user_id = auth()->user()->id;

        $student = Student::where('user_id', $user_id)->first();

        if(isset($_GET['page']) && !empty($_GET['page']))
        {
            $question_id = urlencode($_GET['page']);

            $user_id = auth()->user()->id;

            $response = Response::where('question_id', $question_id)->where('user_id', $user_id)->first();

            return view('exams.questions.start', compact('questions', 'student', 'response'));
        }

        else
        {
            return view('exams.questions.start', compact('student', 'questions'));
        }
    }

    // Let participants check their submissions
    public function checkSubmission()
    {
        $questions = Question::orderBy('id', 'asc')->paginate(1);

        $user_id = auth()->user()->id;

        $student = Student::where('user_id', $user_id)->first();

        if(isset($_GET['page']) && !empty($_GET['page']))
        {
            $question_id = urlencode($_GET['page']);

            $user_id = auth()->user()->id;

            $response = Response::where('question_id', $question_id)->where('user_id', $user_id)->first();

             $score = Response::where('user_id', $user_id)->where('score', '1')->count();

            return view('exams.questions.check', compact('questions', 'student', 'response', 'score'));
        }

        else
        {
            return redirect('/')->with('error', 'Sorry, something went wrong.');
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(auth()->user()->role_id == 2)
        {
            return view('exams.questions.create');
        }
        else
        {
            return redirect('/')->with('error', 'Sorry, you are not authorized to create question');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // Store student's response to the database
    public function storeResponse(QuestionFormRequest $request)
    {
        // Prevent dupllicate entry
        $user_id = $request->input('user_id');
        $question_id = $request->input('question_id');
        $choice = $request->input('choice');

        // Check the answer of question
        $getQuestion = Question::where('id', $question_id)->first();
        $answer = $getQuestion->answer;



        if(Response::where('user_id', $user_id)->where('question_id', $question_id))
        {
            $question = Response::where('user_id', $user_id)->where('question_id', $question_id)->first();

            if (count($question) == 1)
            {
                $question->choice = $request->input('choice');

                // Set scores based on answer
                if($answer == $choice)
                {
                    $question->score = "1";
                }
                else
                {
                    $question->score = "0";
                }

                $question->save();

                return redirect()->back()->with('success', 'You have updated your response.');
            }
            else
            {
                // Let user submit response
                $response = new Response;

                $response->user_id = $request->input('user_id');
                $response->question_id = $request->input('question_id');
                $response->choice = $request->input('choice');

                $response->save();

                return redirect()->back()->with('success', 'You have submitted a response');
            }

        }
        else
        {
            // Let user submit response
            $response = new Response;

            $response->user_id = $request->input('user_id');
            $response->question_id = $request->input('question_id');
            $response->choice = $request->input('choice');

            // Set scores based on answer
            if($answer == $choice)
            {
                $question->score = "1";
            }
            else
            {
                $question->score = "0";
            }


            $response->save();

            return redirect()->back()->with('success', 'You have submitted a response');
        }


     }


    // Store questions in the database
    public function storeQuestion(QuestionUploadFormRequest $request)
        {
            $question = new Question;

            $question->body = $request->input('body');
            $question->option1 = $request->input('option1');
            $question->option2 = $request->input('option2');
            $question->option3 = $request->input('option3');
            $question->option4 = $request->input('option4');
            $question->answer = $request->input('answer');
            $question->status = $request->input('status');

            $question->save();

            return redirect('questions/create')->with('success', 'You created a new question successfully.');
         }


    // This section enables admin to view all questions
         public function view()
         {
            if (auth()->user()->role_id  == 2)
            {
                 $questions = Question::orderBy('id', 'asc')->paginate(10);

                return view('exams.questions.view')->with('questions', $questions);
            }
            else
            {
                return redirect('/')->with('error', 'Sorry, something went wrong. Access denied.');
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
        if(auth()->user()->role_id == 2)
        {
            if(Question::find($id))
            {
                $question = Question::find($id);

                return view('exams.questions.edit')->with('question', $question);
            }
            else
            {
                return redirect('questions/view')->with('error', 'Sorry, something went wrong. Question Not Found.');
            }
        }
        else
        {
            return redirect('/')->with('error', 'Sorry, something went wrong. Access denied.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuestionUploadFormRequest $request, $id)
    {
        if(auth()->user()->role_id == 2)
        {
             if(Question::find($id))
             {
                $question = Question::find($id);

                $question_id = $request->input('question_id');

                $question->body = $request->input('body');
                $question->option1 = $request->input('option1');
                $question->option2 = $request->input('option2');
                $question->option3 = $request->input('option3');
                $question->option4 = $request->input('option4');
                $question->answer = $request->input('answer');

                $question->save();

                return redirect()->back()->with('success', 'You have updated a questions successfully.');
             }
             else
             {
                 return redirect('questions/view')->with('error', 'Sorry, something went wrong. Question Not Found.');
             }
        }
        else
        {
            return redirect('/')->with('error', 'Sorry, something went wrong. Access denied.');
        }
    }

    // Get list of students
    public function mark()
    {
        $users = User::all();

        return view('exams.questions.mark')->with('users', $users);
    }

    // Mark questions
    public function markQuestions($user_id)
    {
        if(auth()->user()->role_id == 2)
        {
            if(Response::where('user_id', $user_id)->first())
            {
                $responses = Response::where('user_id', $user_id)->get();

                foreach($responses as $response)
                {
                    if($response->choice == $response->question->answer)
                    {
                        $response->score = "1";
                    }
                    else
                    {
                        $response->score = "0";
                    }

                    $response->save();
                }

                return redirect()->back()->with('success', 'Marking has been completed.');
            }
            else
            {
                return redirect('/')->with('error', 'Sorry, something went wrong. User Not Found.');
            }

        }
        else
        {
            return redirect('/')->with('error', 'Sorry, something went wrong. Access denied.');
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
