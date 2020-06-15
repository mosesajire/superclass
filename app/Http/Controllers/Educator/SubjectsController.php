<?php

namespace App\Http\Controllers\Educator;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Controllers\Controller;

use App\Http\Requests\SubjectFormRequest;

use App\Http\Requests\SubjectEditFormRequest;

use App\User;

use App\Subject;

class SubjectsController extends Controller
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
            $subjects = Subject::orderBy('id', 'asc')->paginate(10);

            return view('educators.subjects.index')->with('subjects', $subjects);
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
            return view('educators.subjects.create');
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
    public function store(SubjectFormRequest $request)
    {
        // Educator: group_id = 2

        if(auth()->user()->group_id == 2)
        {
            // Handle file upload
            if($request->hasFile('subject_image')) {
            // Get filename with extension
                $fileNameWithExt = $request->file('subject_image')->getClientOriginalName();

                // Get just file name
                $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

                // Get just extension
                $extension = $request->file('subject_image')->getClientOriginalExtension();

                // File name to store
                $fileNameToStore = $filename . "_" . time() . '.' . $extension;

                // Upload image
                $path = $request->file('subject_image')->move('public/subject_images', $fileNameToStore);

            } else {
                $fileNameToStore = 'noimage.jpg';
            }

            $subject = new Subject;

            $subject->name = $request->input('name');
            $subject->description = $request->input('description');
            $subject->user_id = $request->input('user_id');
            $subject->status = $request->input('status');
            $subject->subject_image = $fileNameToStore;
            $subject->save();

            return redirect()->back()->with('success', 'You have created a new subject successfully.');
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
            if(Subject::find($id))
            {
                $subject = Subject::find($id);

                return view('educators.subjects.show')->with('subject', $subject);
            }
            else
            {
                return redirect('/')->with('error', 'Something went wrong. Subject not found.');
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
        if(auth()->user()->group_id == 2)
        {

            if(Subject::find($id))
            {
                $subject = Subject::find($id);

                return view('educators.subjects.edit')->with('subject', $subject);
            }
            else
            {
                return redirect('/')->with('error', 'Something went wrong. Subject not found.');
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
    public function update(SubjectEditFormRequest $request, $id)
    {
         // Educator: group_id = 2

        if(auth()->user()->group_id == 2)
        {
            if(Subject::find($id))
            {
                // Handle file upload
                if($request->hasFile('subject_image'))
                {
                // Get filename with extension
                    $fileNameWithExt = $request->file('subject_image')->getClientOriginalName();

                    // Get just file name
                    $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

                    // Get just extension
                    $extension = $request->file('subject_image')->getClientOriginalExtension();

                    // File name to store
                    $fileNameToStore = $filename . "_" . time() . '.' . $extension;

                    // Upload image
                    $path = $request->file('subject_image')->move('public/subject_images', $fileNameToStore);

                }

                $subject = Subject::find($id);

                if (($request->input('image_action') == 'delete' && $request->hasFile('subject_image')) || ($request->input('image_action') == 'change' && $request->hasFile('subject_image')) || ($request->input('image_action') == 'delete' && !($request->hasFile('subject_image'))) || $request->hasFile('subject_image'))
                {

                    if (($subject->subject_image !== 'noimage.jpg') && ($subject->subject_image !== ""))
                    {
                        $image_path = public_path() . '/public/subject_images/' . $subject->subject_image;

                        // Delete image
                        if (file_exists($image_path))
                        {
                            unlink($image_path);
                        }
                    }
                }

                // Add new image
                if($request->hasFile('subject_image')) {
                    $subject->subject_image = $fileNameToStore;
                }

                if ($request->input('image_action') == 'delete' && !($request->hasFile('subject_image'))) {
                    $subject->subject_image = 'noimage.jpg';
                }

                $subject->name = $request->input('name');
                $subject->description = $request->input('description');
                $subject->status = $request->input('status');

                $subject->save();

                return redirect()->back()->with('success', 'You have updated a subject successfully.');
            }
            else
            {
                return redirect('/')->with('error', 'Something went wrong. Subject not found.');
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
