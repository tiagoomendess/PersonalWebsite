<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;

class LocaleMiddleware
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
        $cookieLocale = $request->cookie('locale');
        $sessionLocale = $request->session()->get('locale', config('app.locale'));
        $locale = $cookieLocale ? $cookieLocale : $sessionLocale;

        App::setLocale($locale);
        $request->session()->flash('locale', $locale);
        $request->setLocale($locale);
        if (empty($cookieLocale)) {
            Cookie::queue('locale', $locale, 525948);
        }

        return $next($request);
    }
}
