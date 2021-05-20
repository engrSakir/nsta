<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()){
            $data = User::orderBy('id', 'desc')->get();
            return datatables::of($data)
                ->addColumn('status', function($data) {
                    if($data->is_active == true){
                        return '<span class="badge badge-pill badge-success">Active</span>';
                    }else{
                        return '<span class="badge badge-pill badge-danger">Inactive</span>';
                    }
                })->addColumn('type', function($data) {
                    if($data->type == 'Super Admin'){
                        return '<span class="badge badge-pill badge-danger">Super Admin</span>';
                    }else if($data->type == 'Admin'){
                        return '<span class="badge badge-pill badge-warning">Admin</span>';
                    }else if($data->type == 'Manager'){
                        return '<span class="badge badge-pill badge-info">Manager</span>';
                    }else if($data->type == 'Customer'){
                        return '<span class="badge badge-pill badge-success">Customer</span>';
                    }
                })->addColumn('image', function($data) {
                    return '<img class="rounded-circle" height="70px;" src="'.asset($data->image ?? get_static_option('no_image')).'" width="70px;" class="rounded-circle" />';
                })->addColumn('action', function($data) {
                    return '<a href="'.route('admin.user.edit', $data).'" class="btn btn-info"><i class="fa fa-edit"></i> </a>
                    <button class="btn btn-danger" onclick="delete_function(this)" value="'.route('admin.user.destroy', $data).'"><i class="fa fa-trash"></i> </button>';
                })
                ->rawColumns(['status','image', 'type','action'])
                ->make(true);
        }else{
            return view('backend.superadmin.user.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.superadmin.user.create');
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
            'name'      =>  'required|string',
            'email'     =>  'required|email|unique:users,email',
            'phone'     =>  'nullable|string',
            'password'  =>  'required|string|min:4',
            'status'    =>  'required|boolean',
            'image'     =>  'required|image',
            'type'     =>  'required|string',
        ]);
        $user = new User();
        $user->name         = $request->name;
        $user->email        = $request->email;
        $user->phone        = $request->phone;
        $user->password     =  bcrypt($request->password);;
        $user->is_active    = $request->status;
        $user->type         = $request->type;
        if($request->hasFile('image')){
            $image             = $request->file('image');
            $folder_path       = 'uploads/images/user/avatar/';
            if (!file_exists($folder_path)) {
                mkdir($folder_path, 0777, true);
            }
            $image_new_name    = Str::random(20).'-'.now()->timestamp.'.'.$image->getClientOriginalExtension();
            //resize and save to server
            Image::make($image->getRealPath())->save($folder_path.$image_new_name);
            $user->image = $folder_path.$image_new_name;
        }
        $user->save();

        return back()->withSuccess('Successfully added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('backend.superadmin.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email,'.$user->id,
            'phone' => 'required|string|unique:users,phone,'.$user->id,
            'password'  =>  'required|string|min:4',
            'status'    =>  'required|boolean',
            'type'     =>  'required|string',
            'image' => 'nullable|image',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password =  bcrypt($request->password);
        $user->is_active    = $request->status;
        $user->type         = $request->type;
        if($request->hasFile('image')){
            if ($user->image != null)
                File::delete(public_path($user->image)); //Old image delete
            $image             = $request->file('image');
            $folder_path       = 'uploads/images/user/avatar/';
            $image_new_name    = Str::random(20).'-'.now()->timestamp.'.'.$image->getClientOriginalExtension();
            //resize and save to server
            Image::make($image->getRealPath())->save($folder_path.$image_new_name);
            $user->image = $folder_path.$image_new_name;
        }
        try {
            $user->save();
            return back()->withSuccess('User updated successfully');
        } catch (\Exception $exception) {
            return back()->withErrors( 'Something went wrong !'.$exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if(User::all()->count() <= 1){
            return response()->json([
                'type' => 'error',
                'message' => 'Minimum 1 admin must need for maintain.'
            ]);
        }
        if(auth()->user()->id == $user->id){
            return response()->json([
                'type' => 'error',
                'message' => 'Don\'t try to delete your self.'
            ]);
        }
        try {
            if ($user->image != null)
                File::delete(public_path($user->image)); //Old image delete
            $user->delete();
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
