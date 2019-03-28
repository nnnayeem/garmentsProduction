<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
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
        if($request->is('admin/roles'))
        {
            if(!$user->can('view role'))abort(401);
        }elseif($request->is('admin/roles/create'))
        {
            if(!$user->can('create role'))abort(401);
        }elseif($request->is('admin/roles/*/edit'))
        {
            if(!$user->can('edit role'))abort(401);
        }elseif($request->is('admin/roles/*'))
        {
            if(!$user->can('delete role'))abort(401);
        }
        return $next($request);
    }
}
