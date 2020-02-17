<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

class CheckIfAdmin
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
        if (!$request->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }
        return $next($request);
    }
}
