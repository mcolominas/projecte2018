<?php

namespace App\Http\Middleware;

use Closure;

use App\Models\User;

class desarrolladorAccessMiddleware
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
        if (User::isDesarrollador() || User::isAdmin()){
            return $next($request);
        }else
            return redirect()->route('index');
    }
}
