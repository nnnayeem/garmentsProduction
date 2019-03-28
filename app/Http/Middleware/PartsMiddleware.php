<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class PartsMiddleware
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
        if($request->is('admin/parts')){
            if(!$user->can('view parts'))abort(401);
        }elseif($request->is('admin/parts/*/create')){
            if(!$user->can('create parts'))abort(401);
        }elseif($request->is('admin/parts/*/edit')){
            if(!$user->can('edit parts'))abort(401);
        }elseif($request->is('admin/parts/*')){
            if(!$user->can('edit parts'))abort(401);
        }
        return $next($request);
    }
}
