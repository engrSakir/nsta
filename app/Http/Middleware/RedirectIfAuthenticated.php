<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                if ($request->user()->type == 'Customer'){
                    return redirect(RouteServiceProvider::CUSTOMER);
                }
                if ($request->user()->type == 'Manager'){
                    return redirect(RouteServiceProvider::MANAGER);
                }
                if ($request->user()->type == 'Admin'){
                    return redirect(RouteServiceProvider::ADMIN);
                }
                if ($request->user()->type == 'Super Admin'){
                    return redirect(RouteServiceProvider::SUPER_ADMIN);
                }
            }
        }
        return $next($request);
    }
}
