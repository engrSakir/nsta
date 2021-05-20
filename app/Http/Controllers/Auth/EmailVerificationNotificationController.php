<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            if ($request->user()->type == 'Customer'){
                return redirect()->intended(RouteServiceProvider::CUSTOMER);
            }
            if ($request->user()->type == 'Manager'){
                return redirect()->intended(RouteServiceProvider::MANAGER);
            }
            if ($request->user()->type == 'Admin'){
                return redirect()->intended(RouteServiceProvider::ADMIN);
            }
            if ($request->user()->type == 'Super Admin'){
                return redirect()->intended(RouteServiceProvider::SUPER_ADMIN);
            }
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->withSuccess('status', 'verification-link-sent kjbdkfbsdk');
    }
}
