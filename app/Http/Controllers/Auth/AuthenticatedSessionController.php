<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        if (Auth::user()->type == 'Customer'){
            return redirect()->intended(RouteServiceProvider::CUSTOMER);
        }
        if (Auth::user()->type == 'Manager'){
            return redirect()->intended(RouteServiceProvider::MANAGER);
        }
        if (Auth::user()->type == 'Admin'){
            return redirect()->intended(RouteServiceProvider::ADMIN);
        }
        if (Auth::user()->type == 'Super Admin'){
            return redirect()->intended(RouteServiceProvider::SUPER_ADMIN);
        }
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if($request->ajax()){
            return response()->json([
                'type' => 'success',
                'message' => 'সঠিকভাবে লগআউট সম্পন্ন হয়েছে। '.config('app.name'),
                'url' => url('/'),
            ]);
        }else{
            return redirect('/');
        }
    }
}
