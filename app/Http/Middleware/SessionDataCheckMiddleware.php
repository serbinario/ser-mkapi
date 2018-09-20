<?php

namespace Serbinario\Http\Middleware;

use Closure;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class SessionDataCheckMiddleware {

    protected $session;
    protected $timeout = 1;

    public function __construct(Store $session){
        $this->session = $session;
    }

    /**
     * Check session data, if role is not valid logout the request
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {

        if(! session('lastActivityTime'))
            $this->session->put('lastActivityTime', time());
        elseif(time() - $this->session->get('lastActivityTime') > $this->timeout){
            auth()->logout();
            return message('You had not activity in '.$this->timeout/60 .' minutes ago.', 'warning', 'login')->withInput(compact('email'))->withCookie($cookie);
        }

//        $bag = Session::getMetadataBag();
//
//        $max = config('session.lifetime') * 60; // min to hours conversion
//
//        if (($bag && $max < (time() - $bag->getLastUsed()))) {
//
//            $request->session()->flush(); // remove all the session data
//
//            Auth::logout(); // logout user
//
//        }

        return $next($request);
    }

}