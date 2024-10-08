<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdministrator
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
        if (\Illuminate\Support\Facades\Auth::user()->hasRole('superAdministrator|administrator')){
            return $next($request);
        }else{
            return redirect()->back();

        }
    }
}
