<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

class ManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $managers = auth()->user()->company->managers;
        return view('backend.admin.manager.index', compact('managers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branches = auth()->user()->company->branches;
        return view('backend.admin.manager.create', compact('branches'));
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
            'image'     =>  'nullable|image',
            'branch'    =>  'required|exists:branches,id',
        ]);

        if (auth()->user()->company->id != Branch::find($request->branch)->company->id){
            return back()->withErrors('You have not access');
        }
        $manager = new User();
        $manager->name         = $request->name;
        $manager->email        = $request->email;
        $manager->phone        = $request->phone;
        $manager->password     =  bcrypt($request->password);;
        $manager->is_active    = $request->status;
        $manager->type         = 'Manager';
        $manager->company_id   = auth()->user()->company->id;
        $manager->branch_id    = $request->branch;

        if($request->hasFile('image')){
            $image             = $request->file('image');
            $folder_path       = 'uploads/images/user/avatar/';
            if (!file_exists($folder_path)) {
                mkdir($folder_path, 0777, true);
            }
            $image_new_name    = Str::random(20).'-'.now()->timestamp.'.'.$image->getClientOriginalExtension();
            //resize and save to server
            Image::make($image->getRealPath())->save($folder_path.$image_new_name);
            $manager->image = $folder_path.$image_new_name;
        }
        $manager->save();

        return redirect()->route('admin.manager.index')->withSuccess('Successfully added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $manager
     * @return \Illuminate\Http\Response
     */
    public function show(User $manager)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $manager
     * @return \Illuminate\Http\Response
     */
    public function edit(User $manager)
    {
        if (auth()->user()->company->id != $manager->company->id){
            return back()->withErrors('You have not access');
        }

        $branches = auth()->user()->company->branches;
        return view('backend.admin.manager.edit', compact('manager', 'branches'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $manager
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $manager)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email,'.$manager->id,
            'phone' => 'required|string|unique:users,phone,'.$manager->id,
            'password'  =>  'nullable|string|min:4',
            'status'    =>  'required|boolean',
            'image'     => 'nullable|image',
            'branch'    =>  'required|exists:branches,id',
        ]);

        if (auth()->user()->company->id != Branch::find($request->branch)->company->id){
            return back()->withErrors('You have not access');
        }

        $manager->name = $request->name;
        $manager->email = $request->email;
        $manager->phone = $request->phone;
        $manager->password =  bcrypt($request->password);
        $manager->is_active    = $request->status;
        $manager->branch_id    = $request->branch;

        if($request->hasFile('image')){
            if ($manager->image != null)
                File::delete(public_path($manager->image)); //Old image delete
            $image             = $request->file('image');
            $folder_path       = 'uploads/images/user/avatar/';
            $image_new_name    = Str::random(20).'-'.now()->timestamp.'.'.$image->getClientOriginalExtension();
            //resize and save to server
            Image::make($image->getRealPath())->save($folder_path.$image_new_name);
            $manager->image = $folder_path.$image_new_name;
        }
        try {
            $manager->save();
            return redirect()->route('admin.manager.index')->withSuccess('Manager updated successfully');
        } catch (\Exception $exception) {
            return back()->withErrors( 'Something went wrong !');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $manager
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $manager)
    {
        if (auth()->user()->company->id != $manager->company->id){
            return response()->json([
                'type' => 'error',
                'message' => 'You have not access'
            ]);
        }

        if ($manager->type != 'Manager'){
            return response()->json([
                'type' => 'error',
                'message' => 'This user is not manager'
            ]);
        }

        try {
            if ($manager->image != null)
                File::delete(public_path($manager->image)); //Old image delete
            $manager->delete();
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
