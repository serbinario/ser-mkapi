<?php

namespace Serbinario\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class AjaxSessionExpiredMiddleware
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
        echo $request->parameterBag;
        if ($request->ajax() && \Auth::guest()) {
            $request->session()->flush(); // remove all the session data

            Auth::logout(); // logout user
        }

        return $next($request);
    }
}