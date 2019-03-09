<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class GeneralStoreMiddleware
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
        if($request->is('admin/general-store')){
            if(!$user->can('view general-store'))abort(401);
        }
        if($request->is('admin/general-store/create')){
            if(!$user->can('request accessories'))abort(401);
        }
        return $next($request);
    }
}
