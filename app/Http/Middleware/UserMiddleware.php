<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserMiddleware
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

        if($request->is('admin/users')){
            if($user->hasPermissionTo('view users'))
                return $next($request);
            else
                abort('401','Unauthorized',['errors.401']);
        }
        if($request->is('admin/users/create')){
            if($user->hasPermissionTo('create users'))
                return $next($request);
            else
                abort('401','Unauthorized',['errors.401']);
        }
        if($request->is('admin/users/*/edit')){
            if($user->hasPermissionTo('edit users'))
                return $next($request);
            else
                abort('401','Unauthorized',['errors.401']);
        }
        if($request->is('admin/users/*')){
            if($user->hasPermissionTo('delete users'))
                return $next($request);
            else
                abort('401','Unauthorized',['errors.401']);
        }

//        return $next($request);
        return redirect('/admin');

    }
}
