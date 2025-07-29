<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class loginRedirectMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    // Example middleware to prevent access to /login
    public function handle($request, Closure $next)
    {
        if ($request->is('login')) {
            // Redirect users or handle the request as desired
            return redirect('/signin');
        }

        return $next($request);
    }
}
