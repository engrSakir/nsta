<?php

namespace App\Http\Controllers\Backend\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use Yajra\DataTables\Facades\DataTables;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()){
            $data = Team::all();
            return datatables::of($data)
                ->addColumn('image', function ($data) {
                    return '<img height="70px;" src="' . asset($data->image ?? get_static_option('no_image')) . '" width="70px;" class="rounded-circle" />';
                })
                ->addColumn('action', function($data) {
                    return '<a href="'.route('superadmin.team.edit', $data).'" class="btn btn-info"><i class="fas fa-edit"></i> </a>
                   <button class="btn btn-danger" onclick="delete_function(this)" value="'.route('superadmin.team.destroy', $data).'"><i class="fas fa-trash"></i> </button>';
                })
                ->rawColumns(['image','action'])
                ->make(true);
        }else{
            return view('backend.superadmin.website.team.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.superadmin.website.team.create');
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
            'name' => 'required|string',
            'image' => 'nullable|image',
            'designation' => 'nullable|string',
            'note' => 'nullable|string',
            'twitter' => 'nullable|string',
            'facebook' => 'nullable|string',
            'instagram' => 'nullable|string',
            'linkedin' => 'nullable|string'
        ]);

        $team = new Team();
        $team->name    =  $request->name;
        $team->designation    =  $request->designation;
        $team->note    =  $request->note;
        $team->twitter    =  $request->twitter;
        $team->facebook    =  $request->facebook;
        $team->instagram    =  $request->instagram;
        $team->linkedin    =  $request->linkedin;
        if ($request->hasFile('image')) {
            $image             = $request->file('image');
            $folder_path       = 'uploads/images/gallery/';
            $image_new_name    = Str::random(20) . '-' . now()->timestamp . '.' . $image->getClientOriginalExtension();
            //resize and save to server
            Image::make($image->getRealPath())->save($folder_path . $image_new_name);
            $team->image   = $folder_path . $image_new_name;
        }
        try {
            $team->save();
            return back()->withToastSuccess('Successfully saved.');
        }catch (\Exception $exception){
            return back()->withErrors('Something going wrong. '.$exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
    {
        return view('backend.superadmin.website.team.edit', compact('team'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team)
    {
        $request->validate([
            'name' => 'required|string',
            'image' => 'nullable|image',
            'designation' => 'nullable|string',
            'note' => 'nullable|string',
            'twitter' => 'nullable|string',
            'facebook' => 'nullable|string',
            'instagram' => 'nullable|string',
            'linkedin' => 'nullable|string'
        ]);

        $team->name    =  $request->name;
        $team->designation    =  $request->designation;
        $team->note    =  $request->note;
        $team->twitter    =  $request->twitter;
        $team->facebook    =  $request->facebook;
        $team->instagram    =  $request->instagram;
        $team->linkedin    =  $request->linkedin;
        if ($request->hasFile('image')) {
            $image             = $request->file('image');
            $folder_path       = 'uploads/images/gallery/';
            $image_new_name    = Str::random(20) . '-' . now()->timestamp . '.' . $image->getClientOriginalExtension();
            //resize and save to server
            Image::make($image->getRealPath())->save($folder_path . $image_new_name);
            $team->image   = $folder_path . $image_new_name;
        }
        try {
            $team->save();
            return back()->withToastSuccess('Successfully saved.');
        }catch (\Exception $exception){
            return back()->withErrors('Something going wrong. '.$exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team)
    {
        try {
            $team->delete();
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

    public function team(){
        return view('backend.superadmin.website.team.team');
    }

    public function teamUpdate(Request $request){
        $request->validate([
            'title' => 'required|string',
            'description' => 'required',
        ]);
        try {
            update_static_option('team_title', $request->title);
            update_static_option('team_description', $request->description);

            return back()->withToastSuccess('Successfully updated.');
        }catch (\Exception $exception){
            return back()->withErrors('Something going wrong. '.$exception->getMessage());
        }
    }
}
