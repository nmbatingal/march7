<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use App\User;

class AdminMiddleware
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
        if ( !Auth::user()->hasRole('System Administrator') )
        {
            abort('403')   ;
        }

        return $next($request);
    }
}
