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
           'reporting_email'    =>  'nullable|email',
           'logo'   =>  'nullable|image|max:800',
           'sms_api_key'   =>  'nullable|string',
           'sms_api_pass'   =>  'nullable|string',
           'conditional_password'   =>  'nullable|string',
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
            update_static_option('sms_api_key', $request->sms_api_key);
            update_static_option('sms_api_pass', $request->sms_api_pass);
            update_static_option('regular_invoice_message_content_for_new_customer', $request->regular_invoice_message_content_for_new_customer);
            update_static_option('regular_invoice_message_content_for_old_customer', $request->regular_invoice_message_content_for_old_customer);
            update_static_option('conditional_password', $request->conditional_password);
            update_static_option('invoice_number_1', $request->invoice_number_1);
            update_static_option('invoice_number_2', $request->invoice_number_2);
            update_static_option('invoice_number_3', $request->invoice_number_3);
            update_static_option('invoice_number_4', $request->invoice_number_4);
            update_static_option('invoice_number_5', $request->invoice_number_5);
            update_static_option('invoice_number_6', $request->invoice_number_6);
            update_static_option('invoice_number_7', $request->invoice_number_7);
            update_static_option('invoice_number_8', $request->invoice_number_8);
            update_static_option('invoice_number_9', $request->invoice_number_9);
            update_static_option('invoice_number_10', $request->invoice_number_10);
            update_static_option('invoice_number_11', $request->invoice_number_11);
            update_static_option('invoice_number_12', $request->invoice_number_12);
            update_static_option('invoice_number_13', $request->invoice_number_13);
            update_static_option('invoice_number_14', $request->invoice_number_14);
            update_static_option('invoice_number_16', $request->invoice_number_16);
            update_static_option('invoice_number_16', $request->invoice_number_16);
            update_static_option('invoice_number_17', $request->invoice_number_17);
            update_static_option('invoice_number_18', $request->invoice_number_18);
            update_static_option('invoice_number_19', $request->invoice_number_19);
            update_static_option('invoice_number_20', $request->invoice_number_20);
            $company->save();
            return back()->withSuccess('Company successfully updated');
        } catch (\Exception $exception) {
            return back()->withErrors( $exception->getMessage());
        }
    }
}
