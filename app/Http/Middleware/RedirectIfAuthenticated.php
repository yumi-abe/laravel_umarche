<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{

    private const GURD_USER = 'users';
    private const GURD_OWNER = 'owners';
    private const GURD_ADMIN = 'admin';

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        // $guards = empty($guards) ? [null] : $guards;

        // foreach ($guards as $guard) {
        //     if (Auth::guard($guard)->check()) {
        //         return redirect(RouteServiceProvider::HOME);
        //     }
        // }

        if(Auth::guard(self::GURD_USER)->check() && $request->routeIs('user.*')){
            return redirect(RouteServiceProvider::HOME);
        }

        if(Auth::guard(self::GURD_OWNER)->check() && $request->routeIs('owner.*')){
            return redirect(RouteServiceProvider::OWNER_HOME);
        }

        if(Auth::guard(self::GURD_ADMIN)->check() && $request->routeIs('amin.*')){
            return redirect(RouteServiceProvider::ADMIN_HOME);
        }

        return $next($request);
    }
}
