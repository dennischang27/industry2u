<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckSeller
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
        if (Auth::check()) {
            if (Auth::user()->is_seller==1) {
                return $next($request);
            } else {
                if ((Auth::user()->is_seller==0)&&(Auth::user()->isbuyer==1)){
                    return redirect(route('upgrade.seller.company'));
                }
                else{

                    return redirect(route('apply.seller.company'));
                }
            }
        } else {
            return redirect(route('login'));

        }
    }
}
