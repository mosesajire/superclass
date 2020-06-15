<?php

namespace App\Http\Controllers\Educator;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Requests\PackageFormRequest;

use App\Http\Requests\PackageEditFormRequest;

use App\Http\Controllers\Controller;

use App\User;

use App\Package;

class PackagesController extends Controller
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
            $packages = Package::orderBy('id', 'asc')->paginate(10);

            return view('educators.packages.index')->with('packages', $packages);
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
            return view('educators.packages.create');
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
    public function store(PackageFormRequest $request)
    {
        // Educator: group_id = 2

        if(auth()->user()->group_id == 2)
        {
            // Handle file upload
            if($request->hasFile('package_image')) {
            // Get filename with extension
                $fileNameWithExt = $request->file('package_image')->getClientOriginalName();

                // Get just file name
                $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

                // Get just extension
                $extension = $request->file('package_image')->getClientOriginalExtension();

                // File name to store
                $fileNameToStore = $filename . "_" . time() . '.' . $extension;

                // Upload image
                $path = $request->file('package_image')->move('public/package_images', $fileNameToStore);

            } else {
                $fileNameToStore = 'noimage.jpg';
            }

            $package = new Package;

            $package->name = $request->input('name');
            $package->description = $request->input('description');
            $package->user_id = $request->input('user_id');
            $package->status = $request->input('status');
            $package->package_image = $fileNameToStore;
            $package->save();

            return redirect()->back()->with('success', 'You have created a new package successfully.');
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
            if(Package::find($id))
            {
                $package = Package::find($id);

                return view('educators.packages.show')->with('package', $package);
            }
            else
            {
                return redirect('/')->with('error', 'Something went wrong. Package not found.');
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

            if(Package::find($id))
            {
                $package = Package::find($id);

                return view('educators.packages.edit')->with('package', $package);
            }
            else
            {
                return redirect('/')->with('error', 'Something went wrong. Package not found.');
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
    public function update(PackageEditFormRequest $request, $id)
    {
         // Educator: group_id = 2

        if(auth()->user()->group_id == 2)
        {
            if(Package::find($id))
            {
                // Handle file upload
                if($request->hasFile('package_image'))
                {
                // Get filename with extension
                    $fileNameWithExt = $request->file('package_image')->getClientOriginalName();

                    // Get just file name
                    $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

                    // Get just extension
                    $extension = $request->file('package_image')->getClientOriginalExtension();

                    // File name to store
                    $fileNameToStore = $filename . "_" . time() . '.' . $extension;

                    // Upload image
                    $path = $request->file('package_image')->move('public/package_images', $fileNameToStore);

                }

                $package = Package::find($id);

                if (($request->input('image_action') == 'delete' && $request->hasFile('package_image')) || ($request->input('image_action') == 'change' && $request->hasFile('package_image')) || ($request->input('image_action') == 'delete' && !($request->hasFile('package_image'))) || $request->hasFile('package_image'))
                {

                    if (($package->package_image !== 'noimage.jpg') && ($package->package_image !== ""))
                    {
                        $image_path = public_path() . '/public/package_images/' . $package->package_image;

                        // Delete image
                        if (file_exists($image_path))
                        {
                            unlink($image_path);
                        }
                    }
                }

                // Add new image
                if($request->hasFile('package_image')) {
                    $package->package_image = $fileNameToStore;
                }

                if ($request->input('image_action') == 'delete' && !($request->hasFile('package_image'))) {
                    $package->package_image = 'noimage.jpg';
                }

                $package->name = $request->input('name');
                $package->description = $request->input('description');
                $package->status = $request->input('status');

                $package->save();

                return redirect()->back()->with('success', 'You have updated a package successfully.');
            }
            else
            {
                return redirect('/')->with('error', 'Something went wrong. Package not found.');
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
