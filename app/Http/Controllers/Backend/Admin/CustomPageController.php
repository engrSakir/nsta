<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\CustomPage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class CustomPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()){
            $data = CustomPage::all();
            return datatables::of($data)
                ->addColumn('writer', function($data) {
                    if($data->writer)
                        return '<span class="badge badge-pill badge-success">'.$data->writer->name.'</span>';
                })
                ->addColumn('status', function($data) {
                    if($data->is_active == true){
                        return '<span class="badge badge-pill badge-success">Active</span>';
                    }else{
                        return '<span class="badge badge-pill badge-danger">Inactive</span>';
                    }
                })->addColumn('image', function($data) {
                    return '<img class="rounded-circle" height="70px;" src="'.asset($data->image ?? get_static_option('no_image')).'" width="70px;" class="rounded-circle" />';
                })->addColumn('action', function($data) {
                    return '<a href="'.route('admin.customPage.edit', $data).'" class="btn btn-info"><i class="fa fa-edit"></i> </a>
                    <button class="btn btn-danger" onclick="delete_function(this)" value="'.route('admin.customPage.destroy', $data).'"><i class="fa fa-trash"></i> </button>';
                })
                ->rawColumns(['writer','status','image','action'])
                ->make(true);
        }else{
            return view('backend.admin.website.custom-page.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.admin.website.custom-page.create');
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
            'name'  =>  'required|string|unique:custom_pages',
            'serial'  =>  'required|numeric|unique:custom_pages',
            'title' =>  'required|string|unique:custom_pages',
            'status'    =>  'required|boolean',
            'description'   =>  'required',
        ]);

        $customPage = new CustomPage();
        $customPage->name   =   $request->name;
        $customPage->slug   =   Str::slug($request->name, '-');
        $customPage->title  =   $request->title;
        $customPage->is_active =   $request->status;
        $customPage->description    =   $request->description;
        $customPage->serial    =   $request->serial;
        $customPage->save();

        return redirect()->route('admin.customPage.edit', $customPage)->withSuccess('Successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(CustomPage $customPage)
    {
        return view('backend.admin.website.custom-page.edit', compact('customPage'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CustomPage $customPage)
    {
        $request->validate([
            'name'  =>  'required|string|unique:custom_pages,name,'.$customPage->id,
            'serial'  =>  'required|numeric|unique:custom_pages,serial,'.$customPage->id,
            'title' =>  'required|string|unique:custom_pages,title,'.$customPage->id,
            'status'    =>  'required|boolean',
            'description'   =>  'required',
        ]);
        $customPage->name   =   $request->name;
        $customPage->slug   =   Str::slug($request->name, '-');
        $customPage->title  =   $request->title;
        $customPage->is_active =   $request->status;
        $customPage->description    =   $request->description;
        $customPage->serial    =   $request->serial;
        $customPage->save();
        return back()->withSuccess('Successfully updated');
    }

    /**
     * @param CustomPage $customPage
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(CustomPage $customPage)
    {
        if ($customPage->id == 1 || $customPage->id == 2){
            return response()->json([
                'type' => 'error',
                'message' => 'You can\'t delete: '. $customPage->name,
            ]);
        }
        try {
            $customPage->delete();
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
