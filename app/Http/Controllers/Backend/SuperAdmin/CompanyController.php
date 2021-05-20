<?php

namespace App\Http\Controllers\Backend\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Package;
use App\Models\PurchasePackage;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use Yajra\DataTables\Facades\DataTables;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()){
            $data = Company::all();
            return datatables::of($data)
                ->addColumn('status', function($data) {
                    if($data->is_active == true){
                        return '<span class="badge badge-pill badge-success">Active</span>';
                    }else{
                        return '<span class="badge badge-pill badge-danger">Inactive</span>';
                    }
                })->addColumn('package', function($data) {
                    return $data->purchasePackage->package->name;
                })->addColumn('logo', function($data) {
                    return '<img class="rounded-circle" height="70px;" src="'.asset($data->logo ?? get_static_option('no_image')).'" width="70px;" class="rounded-circle" />';
                })->addColumn('action', function($data) {
                    return '<a href="'.route('superadmin.company.edit', $data).'" class="btn btn-info"><i class="fa fa-edit"></i> </a>
                    <button class="btn btn-danger" onclick="delete_function(this)" value="'.route('superadmin.company.destroy', $data).'"><i class="fa fa-trash"></i> </button>';
                })
                ->rawColumns(['logo', 'status', 'package', 'action'])
                ->make(true);
        }else{
            return view('backend.superadmin.company.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $packages = Package::where('is_active', true)->get();
        return view('backend.superadmin.company.create', compact('packages'));
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
            'name' => 'required|string|unique:companies,name' ,
            'status' => 'required|boolean',
            'package' => 'required|exists:packages,id',
            'logo' => 'nullable|image',
        ]);

        $company = new Company();
        $company->name      =   $request->name;
        $company->is_active    =   $request->status;
        if($request->hasFile('logo')){
            $image             = $request->file('logo');
            $folder_path       = 'uploads/images/company/logo/';
            if (!file_exists($folder_path)) {
                mkdir($folder_path, 0777, true);
            }
            $image_new_name    = Str::random(20).'-'.now()->timestamp.'.'.$image->getClientOriginalExtension();
            //resize and save to server
            Image::make($image->getRealPath())->save($folder_path.$image_new_name);
            $company->logo = $folder_path.$image_new_name;
        }
        try {
            $company->save();
            $purchase_package = new PurchasePackage();
            $purchase_package->company_id   =   $company->id;
            $purchase_package->package_id   =   $request->package;
            $purchase_package->save();
            return back()->withSuccess('Company successfully added');
        } catch (\Exception $exception) {
            return back()->withErrors( $exception->getMessage());
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        $packages = Package::where('is_active', true)->get();
        return view('backend.superadmin.company.edit', compact('company','packages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        $request->validate([
            'name' => 'required|string|unique:companies,name,'.$company->id,
            'status' => 'required|boolean',
            'package' => 'nullable|exists:packages,id',
            'logo' => 'nullable|image',
        ]);

        $company->name      =   $request->name;
        $company->is_active    =   $request->status;
        if($request->hasFile('logo')){
            if ($company->logo != null)
                File::delete(public_path($company->logo)); //Old logo delete
            $image             = $request->file('logo');
            $folder_path       = 'uploads/images/company/logo/';
            if (!file_exists($folder_path)) {
                mkdir($folder_path, 0777, true);
            }
            $image_new_name    = Str::random(20).'-'.now()->timestamp.'.'.$image->getClientOriginalExtension();
            //resize and save to server
            Image::make($image->getRealPath())->save($folder_path.$image_new_name);
            $company->logo = $folder_path.$image_new_name;
        }
        try {
            $company->save();
            if($request->package){
                $purchase_package = new PurchasePackage();
                $purchase_package->company_id   =   $company->id;
                $purchase_package->package_id   =   $request->package;
                $purchase_package->save();
            }
            return back()->withSuccess('Company successfully updated');
        } catch (\Exception $exception) {
            return back()->withErrors( $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        try {
            if ($company->logo != null)
                File::delete(public_path($company->logo)); //Old image delete
            $company->delete();
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
