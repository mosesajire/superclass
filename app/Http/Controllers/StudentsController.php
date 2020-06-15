<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Requests\StudentFormRequest;

use App\Http\Requests\StudentUpdateFormRequest;

use Illuminate\Support\Facades\File;

use App\Student;

use App\User;

use App\Response;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->role_id == 2)
        {
            $students = Student::all();

            return view('exams.students.index')->with('students', $students);
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
        if(auth()->user()->role_id == 2)
        {
            return view('exams.students.create');
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
    public function store(StudentFormRequest $request)
    {
        if(auth()->user()->role_id == 2)
        {
            $student = new Student;

            $section_a = $request->input('section_a');
            $section_b1 = $request->input('section_b1');
            $section_b2 = $request->input('section_b2');
            $section_b3 = $request->input('section_b3');
            $section_b4 = $request->input('section_b4');
            $section_b5 = $request->input('section_b5');

            // Initialize some values to 0
                $section_a = $section_b1 = $section_b2 = $section_b3 = $section_b4 = $section_b5 = 0;

                if ($request->input('section_a') != "")
                {
                    $section_a = $request->input('section_a');
                }
                if ($request->input('section_b1') != "")
                {
                    $section_b1 = $request->input('section_b1');
                }
                if ($request->input('section_b2') != "")
                {
                    $section_b2 = $request->input('section_b2');
                }
                if ($request->input('section_b3') != "")
                {
                    $section_b3 = $request->input('section_b3');
                }
                if ($request->input('section_b4') != "")
                {
                    $section_b4 = $request->input('section_b4');
                }
                if ($request->input('section_b5') != "")
                {
                    $section_b5 = $request->input('section_b5');
                }

            $total_score = $section_a + $section_b1 + $section_b2 + $section_b3 + $section_b4 + $section_b5;

            $student->user_id = $request->input('user_id');
            $student->reg_number = $request->input('reg_number');
            $student->total_score = $total_score;
            $student->section_a = $request->input('section_a');
            $student->section_b1 = $request->input('section_b1');
            $student->section_b2 = $request->input('section_b2');
            $student->section_b3 = $request->input('section_b3');
            $student->section_b4 = $request->input('section_b4');
            $student->section_b5 = $request->input('section_b5');
            $student->remarks = $request->input('remarks');

            $student->save();

            return redirect()->back()->with('success', 'You have created a new student successfully.');
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
        if(auth()->user()->role_id == 2)
        {
            if(Student::find($id))
            {
                $student = Student::find($id);

                // Get the user_id of student
                $user_id = $student->user_id;

                // Total score
                $section_a = Response::where('user_id', $user_id)->where('score', '1')->count();

                // Get the details of the student
                $user = User::where('id', $user_id);

                return view('exams.students.show', compact('student', 'section_a', 'user'));
            }
            else
            {
                return redirect()->back()->with('error', 'Something went wrong. Student Not Found.');
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
        if(auth()->user()->role_id == 2)
        {
            if(Student::find($id))
            {
                $student = Student::find($id);

                $user_id = $student->user_id;

                // Total score
                $section_a = Response::where('user_id', $user_id)->where('score', '1')->count();

                $user = User::where('id', $user_id);

                return view('exams.students.edit', compact('student', 'section_a', 'user'));
            }
            else
            {
                return redirect()->back()->with('error', 'Something went wrong. Student Not Found.');
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
    public function update(StudentUpdateFormRequest $request, $id)
    {
        if(auth()->user()->role_id == 2)
        {
            if(Student::find($id))
            {
                $student_user_id = $request->input('user_id');

                // Handle uploading of certificate
                if($request->hasFile('certificate'))
                {
                    // Get filename with extension
                    $fileNameWithExt = $request->file('certificate')->getClientOriginalName();

                    // Get just file name
                    $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

                    // Get just extension
                    $extension = $request->file('certificate')->getClientOriginalExtension();

                    // File name to store
                    $fileNameToStore = $student_user_id . "_" . $filename . "_" . time() . '.' . $extension;

                    // Upload image
                    $path = $request->file('certificate')->move('public/certificates', $fileNameToStore);

                }

                // Begin updating
                $student = Student::find($id);

                // Remove certificate from storage if present
                if (($request->input('action') == 'delete' && $request->hasFile('certificate')) || ($request->input('action') == 'change' && $request->hasFile('certificate')) || ($request->input('action') == 'delete' && !($request->hasFile('certificate'))) || $request->hasFile('certificate'))
                {

                    if ($student->certificate !== "")
                    {
                        $certificate = public_path() . '/public/certificates/' . $student->certificate;

                        // Delete image
                        if (file_exists($certificate))
                        {
                            unlink($certificate);
                        }
                    }
                }

                // Add certificate to database
                if($request->hasFile('certificate')) {
                    $student->certificate = $fileNameToStore;
                }

                if ($request->input('action') == 'delete' && !($request->hasFile('certificate'))) {
                    $student->certificate = "";
                }

                $section_a = $request->input('section_a');
                $section_b1 = $request->input('section_b1');
                $section_b2 = $request->input('section_b2');
                $section_b3 = $request->input('section_b3');
                $section_b4 = $request->input('section_b4');
                $section_b5 = $request->input('section_b5');

                $total_score = $section_a + $section_b1 + $section_b2 + $section_b3 + $section_b4 + $section_b5;

                $student->reg_number = $request->input('reg_number');
                $student->total_score = $total_score;

                $student->section_a = $request->input('section_a');

                $student->section_b1 = $request->input('section_b1');
                $student->section_b2 = $request->input('section_b2');
                $student->section_b3 = $request->input('section_b3');
                $student->section_b4 = $request->input('section_b4');
                $student->section_b5 = $request->input('section_b5');
                $student->remarks = $request->input('remarks');

                $student->save();

                return redirect()->back()->with('success', 'You have updated a student successfully.');
            }
            else
            {
                return redirect()->back()->with('error', 'Something went wrong. Student Not Found.');
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
