<?php

namespace App\Http\Controllers\Backend\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index(){
        return view('backend.superadmin.website.about.index');
    }

    public function update(Request $request){
        update_static_option('about_description', $request->description);
        update_static_option('about_title', $request->title);
        return back()->withToastSuccess('About updated');
    }
}
