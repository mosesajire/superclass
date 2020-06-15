<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Requests\ImageFormRequest;

use App\Http\Requests\ImageUpdateFormRequest;

use App\Image;

use App\User;

use DB;


class ImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $images = Image::orderBy('id', 'desc')->paginate(5);

        return view('admin.images.index')->with('images', $images);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.images.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ImageFormRequest $request)
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

        $image = new Image;
        $image->name = $request->input('name');
        $image->description = $request->input('description');
        $image->path = $fileNameToStore;
        $image->status = $request->input('status');
        $image->user_id = auth()->user()->id;
        $image->save();

        return redirect('/admin/images/create')->with('success', 'Image Uploaded Successfully!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        if(Image::find($id)) {
            $image = Image::find($id);

            return view('admin.images.show')->with('image', $image);
        }
        else
        {
            return redirect('/admin/images')->with('error', 'Sorry, something went wrong. The page could not be found!');
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
        if (Image::find($id))
        {
            // Get image id
            $image = Image::find($id);


            return view('admin.images.edit')->with('image', $image);


        }
        else
        {
            return redirect('/admin/images')->with('error', 'Sorry, something went wrong.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ImageUpdateFormRequest $request, $id)
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



        if(Image::find($id))
        {
            $image = Image::find($id);

            // Delete image from storage.
            if(($image->path !== 'noimage.jpg' && $request->hasFile('cover_image')) || $request->input('image_action') == 'delete')
            {
                // Get path of image
                $image_path = public_path() . '/public/cover_images/' . $image->cover_image;

                // Delete image
                if (file_exists($image_path))
                {
                    unlink($image_path);
                }
            }

            $image->name = $request->get('name');
            $image->description = $request->get('description');

            // Add new image
            if($request->hasFile('cover_image')) {
                $image->path = $fileNameToStore;
            }

            if ($request->input('image_action') == 'delete' && !($request->hasFile('cover_image'))) {
                $image->path = 'noimage.jpg';
            }

            $image->save();

            return redirect('/admin/images/'. $id)->with('success', 'Image Updated Successfully!');
        }
        else
        {
            return redirect('/admin/images')->with('error', 'Sorry, something went wrong.');
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
        if (Image::find($id))
        {
            $image = Image::find($id);

            // Check for correct user
             if(auth()->user()->id !== $image->user_id)
             {
                return redirect('/admin/images')->with('error', 'Sorry, you cannot delete someone else\'s image.');
             }
             else
             {
                // Get path of image
                $image_path = public_path() . '/public/cover_images/' . $image->path;

                // Delete image from storage
                if($image->path !== 'noimage.jpg')
                {
                    // Delete image
                    if (file_exists($image_path))
                    {
                        unlink($image_path);
                    }

                    $image->delete();

                    return redirect('/admin/dashboard')->with('success', 'The image has been deleted successfully.');
                }
                else
                {
                    $image->delete();
                    return redirect('/admin/dashboard')->with('success', 'Image Deleted');
                }
             }
        }
        else
        {
            return redirect('/admin/images')->with('error', 'Sorry, something went wrong.');
        }
    }
}
