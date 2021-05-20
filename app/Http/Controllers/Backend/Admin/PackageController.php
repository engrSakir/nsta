<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index(){
        $packages = Package::where('is_active', true)->get();
        return view('backend.admin.package.index', compact('packages'));
    }
}
