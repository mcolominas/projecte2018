<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Auth;

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
            $user = Auth::user();

        if ($user->isDesarrollador() || $user->isAdmin()){
            return $next($request);
        }else
            return redirect()->route('index');
    }
}
