<?php

namespace App\Http\Controllers\Backend\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Package;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()){
            $data = Package::all();
            return datatables::of($data)
                ->addColumn('status', function($data) {
                    if($data->is_active == true){
                        return '<span class="badge badge-pill badge-success">Active</span>';
                    }else{
                        return '<span class="badge badge-pill badge-danger">Inactive</span>';
                    }
                })->addColumn('purchase', function($data) {
                    return $data->purchases->count();
                })->addColumn('action', function($data) {
                    return '<a href="'.route('superadmin.package.edit', $data).'" class="btn btn-info m-1"><i class="fa fa-edit"></i> </a>
                    <button class="btn btn-danger m-1" onclick="delete_function(this)" value="'.route('superadmin.package.destroy', $data).'"><i class="fa fa-trash"></i> </button>';
                })
                ->rawColumns(['status', 'purchase', 'action'])
                ->make(true);
        }else{
            return view('backend.superadmin.package.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.superadmin.package.create');
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
           'name'=>'required|string|unique:packages,name',
           'branch'=>'required|numeric|min:0',
           'admin'=>'required|numeric|min:0',
           'manager'=>'required|numeric|min:0',
           'customer'=>'required|numeric|min:0',
           'invoice'=>'required|numeric|min:0',
           'free_sms'=>'required|numeric|min:0',
           'price_per_message'=>'required|numeric|min:0',
           'duration'=>'required|numeric|min:0',
           'price'=>'required|numeric|min:0',
           'status'=>'required|boolean',
        ]);

        $package = new Package();
        $package->is_active =   $request->status;
        $package->name  =   $request->name;
        $package->branch    =   $request->branch;
        $package->admin =   $request->admin;
        $package->manager   =   $request->manager;
        $package->customer  =   $request->customer;
        $package->invoice   =   $request->invoice;
        $package->free_sms   =   $request->free_sms;
        $package->price_per_message   =   $request->price_per_message;
        $package->duration   =   $request->duration;
        $package->price   =   $request->price;
        try {
            $package->save();
            return back()->withSuccess('Package successfully added');
        } catch (\Exception $exception) {
            return back()->withErrors( $exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function show(Package $package)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function edit(Package $package)
    {
        return view('backend.superadmin.package.edit', compact('package'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Package $package)
    {
        $request->validate([
            'name'=>'required|string|unique:packages,name,'.$package->id,
            'branch'=>'required|numeric|min:0',
            'admin'=>'required|numeric|min:0',
            'manager'=>'required|numeric|min:0',
            'customer'=>'required|numeric|min:0',
            'invoice'=>'required|numeric|min:0',
            'free_sms'=>'required|numeric|min:0',
            'price_per_message'=>'required|numeric|min:0',
            'duration'=>'required|numeric|min:0',
            'price'=>'required|numeric|min:0',
            'status'=>'required|boolean',
        ]);

        $package->is_active =   $request->status;
        $package->name  =   $request->name;
        $package->branch    =   $request->branch;
        $package->admin =   $request->admin;
        $package->manager   =   $request->manager;
        $package->customer  =   $request->customer;
        $package->invoice   =   $request->invoice;
        $package->free_sms   =   $request->free_sms;
        $package->price_per_message   =   $request->price_per_message;
        $package->duration   =   $request->duration;
        $package->price   =   $request->price;
        try {
            $package->save();
            return back()->withSuccess('Package successfully updated');
        } catch (\Exception $exception) {
            return back()->withErrors( $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function destroy(Package $package)
    {
        try {
            $package->delete();
            return response()->json([
                'type' => 'success',
                'message' => ''
            ]);
        }catch (\Exception $exception){
            return response()->json([
                'type' => 'error',
                'message' => $exception->getMessage()
            ]);
        }
    }
}
