<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param  \Illuminate\Foundation\Auth\EmailVerificationRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(EmailVerificationRequest $request)
    {
        if ($request->user()->hasVerifiedEmail()) {

            if ($request->user()->type == 'Customer'){
                return redirect()->intended(RouteServiceProvider::CUSTOMER.'?verified=1');
            }
            if ($request->user()->type == 'Manager'){
                return redirect()->intended(RouteServiceProvider::MANAGER.'?verified=1');
            }
            if ($request->user()->type == 'Admin'){
                return redirect()->intended(RouteServiceProvider::ADMIN.'?verified=1');
            }
            if ($request->user()->type == 'Super Admin'){
                return redirect()->intended(RouteServiceProvider::SUPER_ADMIN.'?verified=1');
            }
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        if ($request->user()->type == 'Customer'){
            return redirect()->intended(RouteServiceProvider::CUSTOMER.'?verified=1');
        }
        if ($request->user()->type == 'Manager'){
            return redirect()->intended(RouteServiceProvider::MANAGER.'?verified=1');
        }
        if ($request->user()->type == 'Admin'){
            return redirect()->intended(RouteServiceProvider::ADMIN.'?verified=1');
        }
        if ($request->user()->type == 'Super Admin'){
            return redirect()->intended(RouteServiceProvider::SUPER_ADMIN.'?verified=1');
        }
    }
}
