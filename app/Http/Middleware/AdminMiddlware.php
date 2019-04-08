<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class AdminMiddlware
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
    	if (!config('app.debug') && (!Auth::check() || Auth::id() !== 60)) {
		    abort(403, 'Unauthorized action.');
	    }
        return $next($request);
    }
}
