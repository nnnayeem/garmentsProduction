<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class MachineMiddleware
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

        if($request->is('admin/machines')){
            if($user->hasPermissionTo('view machines'))
                return $next($request);
            else
                abort('401','Unauthorized',['errors.401']);
        }
        if($request->is('admin/machines/create')){
            if($user->hasPermissionTo('create machines'))
                return $next($request);
            else
                abort('401','Unauthorized',['errors.401']);
        }
        if($request->is('admin/machines/*/edit')){
            if($user->hasPermissionTo('edit machines'))
                return $next($request);
            else
                abort('401','Unauthorized',['errors.401']);
        }
        if($request->is('admin/machines/*')){
            if($user->hasPermissionTo('delete machines'))
                return $next($request);
            else
                abort('401','Unauthorized',['errors.401']);
        }

//        return $next($request);
        return redirect('/admin');

    }
}
