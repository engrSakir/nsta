<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'phone' => 'required|string',
        ]);

        $user = \App\Models\User::where('phone', $request->phone)->first();
        $password = Str::random(4);
        if(sms($request->phone, 'নিউ শাপলা ট্রান্সপোর্ট এজেন্সি সফটওয়্যারে লগইন করার নতুন পাসওয়ার্ড হচ্ছে: '. $password)){
            $user->password = bcrypt($password);
            $user->save();
            return redirect()->route('login')->withSuccess('সফলভাবে নতুন পাসওয়ার্ড আপনার ফোন নাম্বারে পাঠানো হয়েছে');
        }else{
            return back()->withErrors('পর্যাপ্ত পরিমাণ মেসেজ না থাকায় বর্তমানে পাসওয়ার্ড পরিবর্তন করা সম্ভব হচ্ছে না');
        }


    }
}
