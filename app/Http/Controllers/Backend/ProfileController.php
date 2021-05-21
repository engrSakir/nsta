<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\MoreUserInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;

class ProfileController extends Controller
{
    public function index(){
        return view('backend.profile.index');
    }

     // profiles password update
    public function profilePasswordUpdate(Request $request){
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6'
        ]);

        $hashedPassword = Auth::user()->password;

        if (Hash::check($request->old_password, $hashedPassword)) {
            if (!Hash::check($request->password, $hashedPassword)) {
                $users = User::find(Auth::user()->id);
                $users->password = bcrypt($request->password);
                User::where('id', Auth::user()->id)->update(array('password' =>  $users->password));
                return back()->withToastSuccess( 'Password updated successfully');
            } else {
                return back()->withErrors( 'New password can not be the old password !');
            }
        } else {
            return back()->withErrors('Old password doesnt matched !');
        }
    }

     // profile Info Update
    public function profileInfoUpdate(Request $request){
        $request->validate([
            'avatar' => 'nullable|image',
            'address' => 'nullable',
            'facebook' => 'nullable',
            'twitter' => 'nullable',
            'youtube' => 'nullable',
            'map' => 'nullable',
            'name' => 'required|string',
            'phone' => 'nullable|unique:users,phone,'.Auth::user()->id,
            'email' => 'nullable|string|unique:users,email,'.Auth::user()->id,
            'username' => 'nullable|string|max:50|alpha_dash|unique:users,username,'.Auth::user()->id,
        ]);

        if($request->phone == null && $request->email == null && $request->username == null){
            return back()->withErrors( 'Required phone/email/username');
        }

        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->username = $request->username;

        if($request->hasFile('avatar')){
            if ($user->image != null)
                File::delete(public_path($user->image)); //Old image delete
            $image             = $request->file('avatar');
            $folder_path       = 'uploads/images/user/avatar/';
            $image_new_name    = Str::random(20).'-'.now()->timestamp.'.'.$image->getClientOriginalExtension();
            //resize and save to server
            Image::make($image->getRealPath())->save($folder_path.$image_new_name);
            $user->image = $folder_path.$image_new_name;
        }
        try {
            $user->save();
            return back()->withSuccess('Profile updated successfully');
        } catch (\Exception $exception) {
            return back()->withErrors( 'Something went wrong !'.$exception->getMessage());
        }
   }
}
