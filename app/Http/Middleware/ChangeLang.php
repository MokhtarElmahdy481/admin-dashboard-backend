<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class ChangeLang
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(session()->has("locale") && session()->get("locale") == "en"){
            App::setLocale("en");
        }elseif(session()->has("locale") && session()->get("locale")=="ar"){
            App::setLocale("ar");
        }

        return $next($request);
    }
}
