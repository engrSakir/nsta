<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function __invoke(Request $request)
    {
        if (Auth::user()->type == 'Customer'){
            return $request->user()->hasVerifiedEmail()
                ? redirect()->intended(RouteServiceProvider::CUSTOMER)
                : view('auth.verify-email');
        }

        if (Auth::user()->type == 'Manager'){
             return $request->user()->hasVerifiedEmail()
                ? redirect()->intended(RouteServiceProvider::MANAGER)
                : view('auth.verify-email');
        }

        if (Auth::user()->type == 'Admin'){
             return $request->user()->hasVerifiedEmail()
                ? redirect()->intended(RouteServiceProvider::ADMIN)
                : view('auth.verify-email');
        }

        if (Auth::user()->type == 'Super Admin'){
             return $request->user()->hasVerifiedEmail()
                ? redirect()->intended(RouteServiceProvider::SUPER_ADMIN)
                : view('auth.verify-email');
        }
    }
}
