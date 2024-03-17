<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        // dd('RedirectIfAuthenticated', Auth::guard('web')->check());

        // if (Auth::guard('web')->check()) return redirect(RouteServiceProvider::HOME);
        if (Auth::guard('web')->check()) {
            header("Location: /presence-dashboard");
            die();
        }
        dd('hehehe');

        // dd($guards);
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                dd('ddddddd', $guard);
                return redirect(RouteServiceProvider::HOME);
            }
        }

        return $next($request);
    }
}
