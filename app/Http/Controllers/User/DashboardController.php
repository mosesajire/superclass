<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Controllers\Controller;

use App\Lesson;

use App\Enrolment;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;

        $enrolments = Enrolment::where('user_id', $user_id)->paginate(5);

    	$lessons = Lesson::where('status', 1)->orderBy('id', 'desc')->paginate(10);

        return view('user.dashboard', compact('lessons', 'enrolments'));

    }


}
