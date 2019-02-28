<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class PermissionMiddleware
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

        if($request->is('admin/permission')){
            if($user->hasPermissionTo('view permission'))
                return $next($request);
            else
                abort('401','Unauthorized',['errors.401']);
        }
        if($request->is('admin/permission/create')){
            if($user->hasPermissionTo('create permission'))
                return $next($request);
            else
                abort('401','Unauthorized',['errors.401']);
        }
        if($request->is('admin/permission/*/edit')){
            if($user->hasPermissionTo('edit permission'))
                return $next($request);
            else
                abort('401','Unauthorized',['errors.401']);
        }
        if($request->is('admin/permission/*')){
            if($user->hasPermissionTo('delete permission'))
                return $next($request);
            else
                abort('401','Unauthorized',['errors.401']);
        }

//        return $next($request);
        return redirect('/admin');

    }
}
