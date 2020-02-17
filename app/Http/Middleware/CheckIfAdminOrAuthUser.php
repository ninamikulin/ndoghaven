<?php

namespace App\Http\Middleware;

use Closure;

class checkIfAdminOrAuthUser
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
        //dd($request->route('user')->articles);
        if ($request->user()->isAdmin() | $request->route('user')->id === auth()->id()) 
        {
            return $next($request);
            
        } else{
            abort(403, 'Unauthorized action.');
        }
        
    }
}
