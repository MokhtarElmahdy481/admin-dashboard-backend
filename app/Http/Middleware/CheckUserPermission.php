<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,$permission): Response
    {
        if (!Auth::user()->role_id) {
            return redirect(url('/redirect'));
        }
        if(!Auth::user()->role->permisions->contains('title',$permission)){
            return redirect(url('/redirect'));

        }
        return $next($request);
    }
}
