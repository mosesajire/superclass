<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\File;

use App\Http\Requests;

use App\Http\Requests\PostFormRequest;

use App\Post;

use App\User;

use App\Category;

use DB;

// use Storage;

class PostsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(isset($_GET['user']) && isset($_GET['name']) && !empty($_GET['user']) && !empty($_GET['name']))
        {
            $user_id = urlencode($_GET['user']);
            $user_name = urldecode($_GET['name']);

            $posts = Post::where('user_id', $user_id)->orderBy('id', 'desc')->paginate(5);
            $title = "Posts Written By " . $user_name;
        }
        else
        {
            $posts = Post::orderBy('id', 'desc')->paginate(5);
            $title = "All Posts";

        }

        return view('admin.posts.index', compact('posts', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('admin.posts.create')->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostFormRequest $request)
    {
        // Handle file upload
        if($request->hasFile('cover_image')) {
            // Get filename with extension
            $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();

            // Get just file name
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            // Get just extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();

            // File name to store
            $fileNameToStore = $filename . "_" . time() . '.' . $extension;

            // Upload image
            $path = $request->file('cover_image')->move('public/cover_images', $fileNameToStore);

        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        $post = new Post;
        $post->category_id = $request->input('category_id');
        $post->user_id = auth()->user()->id;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->cover_image = $fileNameToStore;
        $post->status = $request->input('status');
        $post->save();

        return redirect('/admin/posts/')->with('success', 'Post Created Successfully!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        if(Post::find($id)) {
            $post = Post::find($id);

            return view('admin.posts.show')->with('post', $post);
        }
        else
        {
            return redirect('/admin/posts')->with('error', 'Sorry, something went wrong. The page could not be found!');
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
        if (Post::find($id))
        {
            // Get post id
            $post = Post::find($id);

            //Get the categories
            $categories = Category::all();

            return view('admin.posts.edit', compact('post', 'categories'));


        }
        else
        {
            return redirect('/admin/posts')->with('error', 'Sorry, something went wrong.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostFormRequest $request, $id)
    {
             // Handle file upload
        if($request->hasFile('cover_image')) {
            // Get filename with extension
            $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();

            // Get just file name
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            // Get just extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();

            // File name to store
            $fileNameToStore = $filename . "_" . time() . '.' . $extension;

            // Upload image
            $path = $request->file('cover_image')->move('public/cover_images', $fileNameToStore);

        }



        if(Post::find($id))
        {
            $post = Post::find($id);

            // Delete image from storage.
            if(($post->cover_image !== 'noimage.jpg' && $request->hasFile('cover_image')) || $request->input('image_action') == 'delete')
            {
                // Get path of image
                $image_path = public_path() . '/public/cover_images/' . $post->cover_image;

                // Delete image
                if (file_exists($image_path))
                {
                    unlink($image_path);
                }
            }

            $post->title = $request->get('title');
            $post->body = $request->get('body');

            // Add new image
            if($request->hasFile('cover_image')) {
                $post->cover_image = $fileNameToStore;
            }

            if ($request->input('image_action') == 'delete' && !($request->hasFile('cover_image'))) {
                $post->cover_image = 'noimage.jpg';
            }

            $post->save();

            return redirect('/admin/posts/'. $id)->with('success', 'Post Updated Successfully!');
        }
        else
        {
            return redirect('/admin/posts')->with('error', 'Sorry, something went wrong.');
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
        if (Post::find($id))
        {
            $post = Post::find($id);

            // Check for correct user
             if(auth()->user()->id !== $post->user_id)
             {
                return redirect('/admin/posts')->with('error', 'Sorry, you cannot delete someone else\'s post.');
             }
             else
             {
                // Get path of image
                $image_path = public_path() . '/public/cover_images/' . $post->cover_image;

                // Delete image from storage
                if($post->cover_image !== 'noimage.jpg')
                {
                    // Delete image
                    if (file_exists($image_path))
                    {
                        unlink($image_path);
                    }

                    $post->delete();

                    return redirect('/admin/posts')->with('success', 'Post Deleted with Image.');
                }
                else
                {
                    $post->delete();
                    return redirect('/admin/posts')->with('success', 'Post Deleted');
                }
             }
        }
        else
        {
            return redirect('/admin/posts')->with('error', 'Sorry, something went wrong.');
        }
    }
}