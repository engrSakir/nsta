<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ConditionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Session::set('variableName', $value);
        if(Session::get('conditional_password') != get_static_option('conditional_password')){
            return redirect()->route('manager.conditionPassword');
        }
        Session::put('conditional_password', null);
        return $next($request);
    }
}
