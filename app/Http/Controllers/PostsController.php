<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\File;

use App\Http\Requests;

use App\Http\Requests\PostFormRequest;

use App\Post;

use App\User;

use App\Category;

use App\Comment;

use DB;

class PostsController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // The category of users' posts is 2

        $posts = Post::where('category_id', 2)->orderBy('id', 'desc')->paginate(10);

        return view('posts.index')->with('posts', $posts);
    }


    public function show($id)
    {

        if(Post::find($id))
        {
            $post = Post::find($id);

            if(!(auth()->guest()))
            {
            	if($post->user_id == auth()->user()->id) // Post's owner
	            {
	                return view('posts.show')->with('post', $post);

	            }
	            else // Not Post's owner
	            {
	               return view('posts.show')->with('post', $post);
	            }
            }
            else  // Guest
            {
            	return view('posts.show')->with('post', $post);
            }
        }
        else
        {
            return redirect('/posts')->with('error', 'Sorry, something went wrong. The page could not be found!');
        }


    }
}
