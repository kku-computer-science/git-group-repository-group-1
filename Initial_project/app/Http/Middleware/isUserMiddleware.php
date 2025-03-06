<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class isUserMiddleware
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
        if( Auth::check() && Auth::user()->hasRole('student')){
            return $next($request);
        }
        elseif( Auth::check() && Auth::user()->hasRole('teacher')){
            return $next($request);
        }elseif( Auth::check() && Auth::user()->hasRole('staff')){
            return $next($request);
        }
        else{
            return redirect()->route('login');
        }
    }
}
