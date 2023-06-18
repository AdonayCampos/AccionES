<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */

    public function handle($request, Closure $next, ...$roles)
    {
        if (Auth::check() && Auth::user()->hasAnyRole(...$roles)) {
            return $next($request);
        } elseif (Auth::check() && Auth::user()->usu_rol == 3) {
            return redirect("/reportes");
        }
        return redirect("/");
    }
}