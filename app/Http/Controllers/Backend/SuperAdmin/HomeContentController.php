<?php

namespace App\Http\Controllers\Backend\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\HomeContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use Yajra\DataTables\Facades\DataTables;

class HomeContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()){
            $data = HomeContent::orderBy('id', 'desc')->get();
            return datatables::of($data)
                ->addColumn('faq', function($data) {
                    if($data->homeContentFaqs)
                        return '<span class="badge badge-pill badge-success">'.$data->homeContentFaqs->count().'</span>';
                })->addColumn('status', function($data) {
                    if($data->is_active == true){
                        return '<span class="badge badge-pill badge-success">Active</span>';
                    }else{
                        return '<span class="badge badge-pill badge-danger">Inactive</span>';
                    }
                })->addColumn('image', function($data) {
                    return '<img class="rounded-circle" height="70px;" src="'.asset($data->image ?? get_static_option('no_image')).'" width="70px;" class="rounded-circle" />';
                })->addColumn('action', function($data) {
                    return '<a href="'.route('superadmin.homeContent.edit', $data).'" class="btn btn-info"><i class="fa fa-edit"></i> </a>
                    <button class="btn btn-danger" onclick="delete_function(this)" value="'.route('superadmin.homeContent.destroy', $data).'"><i class="fa fa-trash"></i> </button>';
                })
                ->rawColumns(['faq','status','image','action'])
                ->make(true);
        }else{
            return view('backend.superadmin.website.home-content.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.superadmin.website.home-content.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'serial' => 'required|integer|unique:home_contents,serial',
            'title' => 'required|string',
            'description' => 'required|string',
            'status' => 'required|boolean',
            'image' => 'nullable|image',
        ]);
        $homeContent = new HomeContent();

        $homeContent->title    =   $request->title;
        $homeContent->is_active    =  $request->status;
        $homeContent->description    =  $request->description;
        $homeContent->serial    =  $request->serial;

        if($request->hasFile('image')){
            $image             = $request->file('image');
            $folder_path       = 'uploads/images/home-content/';
            $image_new_name    = Str::random(20).'-'.now()->timestamp.'.'.$image->getClientOriginalExtension();
            //resize and save to server
            Image::make($image->getRealPath())->save($folder_path.$image_new_name);
            $homeContent->image   = $folder_path . $image_new_name;
        }
        try {
            $homeContent->save();
            return back()->withToastSuccess('Successfully saved.');
        }catch (\Exception $exception){
            return back()->withErrors('Something going wrong. '.$exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HomeContent  $homeContent
     * @return \Illuminate\Http\Response
     */
    public function show(HomeContent $homeContent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HomeContent  $homeContent
     * @return \Illuminate\Http\Response
     */
    public function edit(HomeContent $homeContent)
    {
        return view('backend.superadmin.website.home-content.edit', compact('homeContent'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HomeContent  $homeContent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HomeContent $homeContent)
    {
        $request->validate([
            'serial' => 'required|integer|unique:home_contents,serial,'.$homeContent->id,
            'title' => 'required|string',
            'description' => 'required|string',
            'status' => 'required',
            'image' => 'nullable|image',
        ]);

        $homeContent->serial    =   $request->serial;
        $homeContent->title    =   $request->title;
        $homeContent->is_active    =  $request->status;
        $homeContent->description    =  $request->description;
        if($request->hasFile('image')){
            if ($homeContent->image != null)
                File::delete(public_path($homeContent->image)); //Old image delete
            $image             = $request->file('image');
            $folder_path       = 'uploads/images/home-content/';
            $image_new_name    = Str::random(20).'-'.now()->timestamp.'.'.$image->getClientOriginalExtension();
            //resize and save to server
            Image::make($image->getRealPath())->save($folder_path.$image_new_name);
            $homeContent->image   = $folder_path . $image_new_name;
        }
        try {
            $homeContent->save();
            return back()->withToastSuccess('Successfully updated.');
        }catch (\Exception $exception){
            return back()->withErrors('Something going wrong. '.$exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HomeContent  $homeContent
     * @return \Illuminate\Http\Response
     */
    public function destroy(HomeContent $homeContent)
    {
        try {
            if ($homeContent->image != null)
                File::delete(public_path($homeContent->image)); //Old image delete
            $homeContent->delete();
            return response()->json([
                'type' => 'success',
                 'message' => ''
            ]);
        }catch (\Exception$exception){
            return response()->json([
                'type' => 'error',
                 'message' => ''
            ]);
        }
    }
}
