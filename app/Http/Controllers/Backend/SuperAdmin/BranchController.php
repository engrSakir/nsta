<?php

namespace App\Http\Controllers\Backend\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Company;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()){
            $data = Branch::all();
            return datatables::of($data)
                ->addColumn('status', function($data) {
                    if($data->is_active == true){
                        return '<span class="badge badge-pill badge-success">Active</span>';
                    }else{
                        return '<span class="badge badge-pill badge-danger">Inactive</span>';
                    }
                })->addColumn('company', function($data) {
                    return $data->company->name;
                })->addColumn('logo', function($data) {
                    return '<img class="rounded-circle" height="70px;" src="'.asset($data->company->logo ?? get_static_option('no_image')).'" width="70px;" class="rounded-circle" />';
                })->addColumn('action', function($data) {
                    return '<a href="'.route('superadmin.branch.edit', $data).'" class="btn btn-info"><i class="fa fa-edit"></i> </a>
                    <button class="btn btn-danger" onclick="delete_function(this)" value="'.route('superadmin.branch.destroy', $data).'"><i class="fa fa-trash"></i> </button>';
                })
                ->rawColumns(['logo', 'status', 'company', 'action'])
                ->make(true);
        }else{
            return view('backend.superadmin.branch.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::where('is_active', true)->get();
        return view('backend.superadmin.branch.create', compact('companies'));
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
           'email' => 'nullable|email',
           'phone' => 'nullable|string',
           'address' => 'nullable|string',
           'sender_search_length' => 'required|numeric',
           'receiver_search_length' => 'required|numeric',
           'global_search_length' => 'required|numeric',
           'status' => 'required|boolean',
           'head_office' => 'required|boolean',
           'company' => 'required|exists:companies,id',
        ]);

        $branch = new Branch();
        $branch->company_id = $request->company;
        $branch->name = $request->name;
        $branch->email = $request->email;
        $branch->phone = $request->phone;
        $branch->address = $request->address;
        $branch->sender_search_length = $request->sender_search_length;
        $branch->receiver_search_length = $request->receiver_search_length;
        $branch->global_search_length = $request->global_search_length;
        $branch->is_active = $request->status;
        $branch->is_head_office = $request->head_office;
        try {
            $branch->save();
            return back()->withSuccess('Branch successfully added');
        } catch (\Exception $exception) {
            return back()->withErrors( $exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function show(Branch $branch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function edit(Branch $branch)
    {
        $companies = Company::where('is_active', true)->get();
        return view('backend.superadmin.branch.edit', compact('branch', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Branch $branch)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'sender_search_length' => 'required|numeric',
            'receiver_search_length' => 'required|numeric',
            'global_search_length' => 'required|numeric',
            'status' => 'required|boolean',
            'head_office' => 'required|boolean',
            'company' => 'required|exists:companies,id',
        ]);

        $branch->company_id = $request->company;
        $branch->name = $request->name;
        $branch->email = $request->email;
        $branch->phone = $request->phone;
        $branch->address = $request->address;
        $branch->sender_search_length = $request->sender_search_length;
        $branch->receiver_search_length = $request->receiver_search_length;
        $branch->global_search_length = $request->global_search_length;
        $branch->is_active = $request->status;
        $branch->is_head_office = $request->head_office;

        try {
            $branch->save();
            return back()->withSuccess('Branch successfully updated');
        } catch (\Exception $exception) {
            return back()->withErrors( $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function destroy(Branch $branch)
    {
        try {
            $branch->delete();
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
