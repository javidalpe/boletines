<?php

namespace App\Http\Middleware;

use Closure;

class MemberGetMemberMiddleware
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
        if ($request->token) {
            session(['token' => $request->token]);
        }
        return $next($request);
    }
}
