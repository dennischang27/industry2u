<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckCompanyRegistration
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
            if (Auth::user()->is_buyer==1 || Auth::user()->is_seller==1) {
				return redirect(route('user.company'));
            } else {
                return $next($request);
            }
        } else {
            return redirect(route('login'));

        }
    }
}
