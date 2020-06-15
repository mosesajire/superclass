<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Package;

use App\Subject;

use App\Post;

use App\Category;

class PagesController extends Controller
{
    // Homepage
    public function index() {

        $message = Post::where('id', 3)->first();

        $myIntro1 = Post::where('id', 1)->first();

        $myIntro2 = Post::where('id', 2)->first();

        $subjects = Subject::where('status', 1)->paginate(20);

    	$packages = Package::where('status', 1)->paginate(10);

        return view('pages.index', compact('packages', 'subjects', 'message', 'myIntro1', 'myIntro2'));
    }

    // About
    public function about() {
        $post = Post::where('id', 4)->first();
        return view('pages.about')->with('post', $post);
    }


    // Dashboard
    public function dashboard() {
        if(auth()->user())
        {
            if(auth()->user()->role_id == 1)
            {
                return redirect('/user/dashboard');
            }

            if(auth()->user()->role_id == 2)
            {
                return redirect('/admin/dashboard');
            }
        }
        else
        {
            return view('pages.index')->with('title', $title);
        }
    }

}
