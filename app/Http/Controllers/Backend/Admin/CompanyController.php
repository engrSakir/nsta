<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

class CompanyController extends Controller
{
    public function index(){
        $company = auth()->user()->company;
        return view('backend.admin.company.edit', compact('company'));
    }

    public function update(Request $request){
        $request->validate([
           'name'   =>  'required|string',
           'reporting_email'    =>  'required|email',
           'logo'   =>  'nullable|image|max:800',
        ]);

        $company = auth()->user()->company;
        $company->name              =   $request->name;
        $company->reporting_email   =   $request->reporting_email;

        if($request->hasFile('logo')){
            if ($company->logo != null)
                File::delete(public_path($company->logo)); //Old image delete
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
            return back()->withSuccess('Company successfully updated');
        } catch (\Exception $exception) {
            return back()->withErrors( $exception->getMessage());
        }
    }
}
