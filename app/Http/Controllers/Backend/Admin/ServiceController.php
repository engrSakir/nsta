<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Yajra\DataTables\Facades\DataTables;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()){
            $data = Service::all();
            return datatables::of($data)
                ->addColumn('icon', function($data) {
                    return '<h1>'.$data->icon.'</h1>';
                }) ->addColumn('action', function($data) {
                    return '<a href="'.route('admin.service.edit', $data).'" class="btn btn-info"><i class="fas fa-edit"></i> </a>
                   <button class="btn btn-danger" onclick="delete_function(this)" value="'.route('admin.service.destroy', $data).'"><i class="fas fa-trash"></i> </button>';
                })
                ->rawColumns(['icon', 'action'])
                ->make(true);
        }else{
            return view('backend.admin.website.service.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.admin.website.service.create');
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
        'description' => 'required',
        'icon' => 'required',
        ]);

        $service = new Service();

        $service->name    =   $request->name;
        $service->description    =  $request->description;
        $service->icon    =  $request->icon;

        try {
            $service->save();
            return back()->withToastSuccess('Successfully saved.');
        }catch (\Exception $exception){
            return back()->withErrors('Something going wrong. '.$exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        return view('backend.admin.website.service.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required',
            'icon' => 'required',
        ]);

        $service->name    =   $request->name;
        $service->description    =  $request->description;
        $service->icon    =  $request->icon;

        try {
            $service->save();
            return back()->withToastSuccess('Successfully updated.');
        }catch (\Exception $exception){
            return back()->withErrors('Something going wrong. '.$exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        try {
            $service->delete();
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
    public function service(){
        return view('backend.admin.website.service.service');
    }

    public function serviceUpdate(Request $request){
        $request->validate([
            'title' => 'required|string',
            'description' => 'required',
        ]);
        try {
            update_static_option('service_title', $request->title);
            update_static_option('service_description', $request->description);

            return back()->withToastSuccess('Successfully updated.');
        }catch (\Exception $exception){
            return back()->withErrors('Something going wrong. '.$exception->getMessage());
        }
    }

}
