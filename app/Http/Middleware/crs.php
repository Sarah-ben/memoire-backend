<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class crs
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        return $next($request)
        ->header('Access-Controll-Allow-Origin',"*")
        ->header('Access-Controll-Allow-Methods',"PUT,POST,DELETE,GET,HEAD,OPTIONS")
        ->header('Access-Controll-Allow-Headers',"Accept,Authorization,Content-Type");
    }
}
