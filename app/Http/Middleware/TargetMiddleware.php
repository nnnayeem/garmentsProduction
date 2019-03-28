<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class TargetMiddleware
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
        if($request->is('admin/targets')){
            if(!$user->can('view target'))abort(401);
        }elseif($request->is('admin/targets/create')){
            if(!$user->can('create target'))abort(401);
        }elseif($request->is('admin/targets/*/edit')){
            if(!$user->can('edit target'))abort(401);
        }elseif($request->is('admin/targets/*')){
            if(!$user->can('edit target')||!$user->can('delete target'))abort(401);
        }
        return $next($request);
    }
}
