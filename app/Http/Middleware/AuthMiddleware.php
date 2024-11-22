<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if($request->user()->role == 'admin' || $request->user()->role == 'superadmin'){
            // dd($request->route()->getName());

            if($request->route()->getName() == 'login' || $request->route()->getName() == 'register'){
                return back();
            }
            return $next($request);
        }
        else{
            return back();
        }

    }
}
