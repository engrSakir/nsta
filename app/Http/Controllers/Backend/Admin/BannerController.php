<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

class BannerController extends Controller
{
    public function index(){
        return view('backend.admin.website.banner.index');
    }

    public function update(Request $request){
        update_static_option('banner_highlight', $request->highlight);
        update_static_option('banner_description', $request->description);
        update_static_option('banner_url', $request->url);
        return back()->withToastSuccess('Banner updated');
    }

    public function bannerImageUpdate(Request $request){
        $request->validate([
            'image' => 'required|image',
        ]);
        if($request->hasFile('image')){
            if (get_static_option('banner_image') != null)
                File::delete(public_path(get_static_option('banner_image'))); //Old image delete
            $image             = $request->file('image');
            $folder_path       = 'uploads/images/website/';
            $image_new_name    = Str::random(20).'-'.now()->timestamp.'.'.$image->getClientOriginalExtension();
            //resize and save to server
            Image::make($image->getRealPath())->save($folder_path.$image_new_name);
            update_static_option('banner_image',$folder_path.$image_new_name);
        }
        return response()->json([
            'type' => 'success',
            'message' => 'Successfully Updated',
            'image_url' => $folder_path.$image_new_name
        ]);
    }


}
