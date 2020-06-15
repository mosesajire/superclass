<?php

namespace App\Http\Controllers\Educator;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Requests\LessonFormRequest;

use App\Http\Requests\LessonEditFormRequest;

use App\Http\Controllers\Controller;

use App\Lesson;

use App\User;

use App\Subject;

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
        // Educator: group_id = 2

        if(auth()->user()->group_id == 2)
        {
            // Show lessons of a particular subject
            if(isset($_GET['subject']) && !empty($_GET['subject']))
            {
                $subject_id = urlencode($_GET['subject']);

                $get_subject = Subject::where('id', $subject_id)->first();

                // Show all lessons to admin
                $user_id = auth()->user()->id;

                if(auth()->user()->role_id == 2)
                {
                    $lessons = Lesson::where('subject_id', $subject_id)->orderBy('id', 'asc')->paginate(10)->appends(request()->query());
                }
                else
                {
                    // Show only lessons created by non-admins
                    $lessons = Lesson::where('subject_id', $subject_id)->where('user_id', $user_id)->orderBy('id', 'asc')->paginate(10)->appends(request()->query());
                }
               

                return view('educators.lessons.index', compact('lessons', 'get_subject'));
            }
            // Show lessons of a particular package (class)
            if(isset($_GET['package']) && !empty($_GET['package']))
            {
                $package_id = urlencode($_GET['package']);

                $get_package = Package::where('id', $package_id)->first();

                // Show all lessons to admin
                $user_id = auth()->user()->id;

                if(auth()->user()->role_id == 2)
                {
                    $lessons = Lesson::where('package_id', $package_id)->orderBy('id', 'asc')->paginate(10)->appends(request()->query());
                }
                else
                {
                    // Show only lessons created by non-admins
                    $lessons = Lesson::where('package_id', $package_id)->where('user_id', $user_id)->orderBy('id', 'asc')->paginate(10)->appends(request()->query());
                }

                return view('educators.lessons.index', compact('lessons', 'get_package'));
            }
            else
            {
                // Show all lessons to admin
                $user_id = auth()->user()->id;

                if(auth()->user()->role_id == 2)
                {
                    $lessons = Lesson::orderBy('id', 'asc')->paginate(10);
                }
                else
                {
                    $lessons = Lesson::orderBy('id', 'asc')->where('user_id', $user_id)->paginate(10);
                }

                return view('educators.lessons.index', compact('lessons'));
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
            $subjects = Subject::all();

            $packages = Package::all();

            return view('educators.lessons.create', compact('subjects', 'packages'));
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
    public function store(LessonFormRequest $request)
    {
        // Educator: group_id = 2

        if(auth()->user()->group_id == 2)
        {
            // Handle file upload
            if($request->hasFile('lesson_image')) {
            // Get filename with extension
                $fileNameWithExt = $request->file('lesson_image')->getClientOriginalName();

                // Get just file name
                $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

                // Get just extension
                $extension = $request->file('lesson_image')->getClientOriginalExtension();

                // File name to store
                $fileNameToStore = $filename . "_" . time() . '.' . $extension;

                // Upload image
                $path = $request->file('lesson_image')->move('public/lesson_images', $fileNameToStore);

            } else {
                $fileNameToStore = 'noimage.jpg';
            }

            $lesson = new Lesson;

            $lesson->package_id = $request->input('package_id');
            $lesson->subject_id = $request->input('subject_id');
            $lesson->name = $request->input('name');
            $lesson->description = $request->input('description');
            $lesson->user_id = $request->input('user_id');
            $lesson->status = $request->input('status');
            $lesson->lesson_image = $fileNameToStore;
            $lesson->save();

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
            if(Lesson::find($id))
            {
                $lesson = Lesson::find($id);

                return view('educators.lessons.show')->with('lesson', $lesson);
            }
            else
            {
                return redirect('/')->with('error', 'Something went wrong. Lesson not found.');
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

            if(Lesson::find($id))
            {

                $subjects = Subject::all();

                $packages = Package::all();

                $lesson = Lesson::find($id);

                return view('educators.lessons.edit', compact('subjects', 'packages', 'lesson'));
            }
            else
            {
                return redirect('/')->with('error', 'Something went wrong. Lesson not found.');
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
    public function update(LessonEditFormRequest $request, $id)
    {
        // Educator: group_id = 2

        if(auth()->user()->group_id == 2)
        {
            if(Lesson::find($id))
            {
                // Handle file upload
                if($request->hasFile('lesson_image'))
                {
                // Get filename with extension
                    $fileNameWithExt = $request->file('lesson_image')->getClientOriginalName();

                    // Get just file name
                    $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

                    // Get just extension
                    $extension = $request->file('lesson_image')->getClientOriginalExtension();

                    // File name to store
                    $fileNameToStore = $filename . "_" . time() . '.' . $extension;

                    // Upload image
                    $path = $request->file('lesson_image')->move('public/lesson_images', $fileNameToStore);

                }

                $lesson = Lesson::find($id);

                if (($request->input('image_action') == 'delete' && $request->hasFile('lesson_image')) || ($request->input('image_action') == 'change' && $request->hasFile('lesson_image')) || ($request->input('image_action') == 'delete' && !($request->hasFile('lesson_image'))) || $request->hasFile('lesson_image'))
                {

                    if (($lesson->lesson_image !== 'noimage.jpg') && ($lesson->lesson_image !== ""))
                    {
                        $image_path = public_path() . '/public/lesson_images/' . $lesson->lesson_image;

                        // Delete image
                        if (file_exists($image_path))
                        {
                            unlink($image_path);
                        }
                    }
                }

                // Add new image
                if($request->hasFile('lesson_image')) {
                    $lesson->lesson_image = $fileNameToStore;
                }

                if ($request->input('image_action') == 'delete' && !($request->hasFile('lesson_image'))) {
                    $lesson->lesson_image = 'noimage.jpg';
                }

                $lesson->package_id = $request->input('package_id');
                $lesson->subject_id = $request->input('subject_id');
                $lesson->name = $request->input('name');
                $lesson->description = $request->input('description');
                $lesson->status = $request->input('status');

                $lesson->save();

                return redirect()->back()->with('success', 'You have updated a lesson successfully.');
            }
            else
            {
                return redirect('/')->with('error', 'Something went wrong. Lesson not found.');
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
