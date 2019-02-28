<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class FloorMiddleware
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

        if($request->is('admin/floors')){
            if($user->hasPermissionTo('view floors'))
                return $next($request);
            else
                abort('401','Unauthorized',['errors.401']);
        }
        if($request->is('admin/floors/create')){
            if($user->hasPermissionTo('create floors'))
                return $next($request);
            else
                abort('401','Unauthorized',['errors.401']);
        }
        if($request->is('admin/floors/*/edit')){
            if($user->hasPermissionTo('edit floors'))
                return $next($request);
            else
                abort('401','Unauthorized',['errors.401']);
        }
        if($request->is('admin/floors/*')){
            if($user->hasPermissionTo('delete floors'))
                return $next($request);
            else
                abort('401','Unauthorized',['errors.401']);
        }

//        return $next($request);
        return redirect('/admin');

    }
}
