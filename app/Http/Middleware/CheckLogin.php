<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        if(Auth::check())
        {
            if(Auth::user()->role_id == 1)
            {
                return $response;
            }
            else
            {
                Auth::logout();
                return redirect('/login');
            }
        }
        return $response;
    }
}
