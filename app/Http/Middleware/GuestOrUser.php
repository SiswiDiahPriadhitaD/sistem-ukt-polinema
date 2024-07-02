<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class GuestOrUser
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
        if (Auth::guest() || (Auth::check() && Auth::user()->hasRole('mahasiswa'))) {
            return $next($request);
        }

        // Return a 404 response for unauthorized access
        abort(404);
    }
}
