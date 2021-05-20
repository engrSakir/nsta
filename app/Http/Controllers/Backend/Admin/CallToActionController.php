<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\CallToAction;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CallToActionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = CallToAction::all();
            return datatables::of($data)
                ->addColumn('action_name', function($data) {
                        return '<a href="'.$data->action_url.'" class="text-white btn btn-warning col mb-1" target="_blank">'.$data->action_name.'</a>';
                }) ->addColumn('status', function($data) {
                    if($data->is_active == true){
                        return '<span class="badge badge-pill badge-success">Active</span>';
                    }else{
                        return '<span class="badge badge-pill badge-danger">Inactive</span>';
                    }
                })
                ->addColumn('action', function($data) {
                    return '<a href="'.route('admin.callToAction.edit', $data).'" class="btn btn-info"><i class="fas fa-edit"></i> </a>
                   <button class="btn btn-danger" onclick="delete_function(this)" value="'.route('admin.callToAction.destroy', $data).'"><i class="fas fa-trash"></i> </button>';
                })
                ->rawColumns(['action_name', 'status', 'action'])
                ->make(true);
        } else {
            return view('backend.admin.website.call-to-action.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.admin.website.call-to-action.create');
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
           'title' => 'required|string',
           'name' => 'nullable|string',
           'url' => 'nullable|string',
           'status' => 'required|boolean',
           'description' => 'nullable',
        ]);
        $callToAction = new CallToAction();
        $callToAction->title    =   $request->title;
        $callToAction->description =    $request->description;
        $callToAction->action_name  =  $request->name;
        $callToAction->action_url   =   $request->url;
        $callToAction->is_active  =  $request->status;
        try {
            $callToAction->save();
            return back()->withSuccess('Successfully saved');
        }catch (\Exception $exception){
            return back()->withErrors('Some went wrong. '.$exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CallToAction  $callToAction
     * @return \Illuminate\Http\Response
     */
    public function show(CallToAction $callToAction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CallToAction  $callToAction
     * @return \Illuminate\Http\Response
     */
    public function edit(CallToAction $callToAction)
    {
        return view('backend.admin.website.call-to-action.edit', compact('callToAction'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CallToAction  $callToAction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CallToAction $callToAction)
    {
        $request->validate([
            'title' => 'required|string',
            'name' => 'nullable|string',
            'url' => 'nullable|string',
            'status' => 'required|boolean',
            'description' => 'nullable',
        ]);

        $callToAction->title    =   $request->title;
        $callToAction->description =    $request->description;
        $callToAction->action_name  =  $request->name;
        $callToAction->action_url   =   $request->url;
        $callToAction->is_active  =  $request->status;
        try {
            $callToAction->save();
            return back()->withSuccess('Successfully saved');
        }catch (\Exception $exception){
            return back()->withErrors('Some went wrong. '.$exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CallToAction  $callToAction
     * @return \Illuminate\Http\Response
     */
    public function destroy(CallToAction $callToAction)
    {
        try {
            $callToAction->delete();
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
