<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cookie;

class SecurityPIN
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
        $pin = $request->cookie('token_admin_pin', 0);

        if ($pin == config('custom.token_admin_pin')) {
            return $next($request);
        } else {
            Cookie::queue('token_admin_pin_redirect', $request->url(), 525948);
            return redirect(route('show_pin'));
        }
    }
}
