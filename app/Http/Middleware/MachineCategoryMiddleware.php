<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class MachineCategoryMiddleware
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

        if($request->is('admin/machine-category')){
            if($user->hasPermissionTo('view machine-category'))
                return $next($request);
            else
                abort('401','Unauthorized',['errors.401']);
        }
        if($request->is('admin/machine-category/create')){
            if($user->hasPermissionTo('create machine-category'))
                return $next($request);
            else
                abort('401','Unauthorized',['errors.401']);
        }
        if($request->is('admin/machine-category/*/edit')){
            if($user->hasPermissionTo('edit machine-category'))
                return $next($request);
            else
                abort('401','Unauthorized',['errors.401']);
        }
        if($request->is('admin/machine-category/*')){
            if($user->hasPermissionTo('delete machine-category'))
                return $next($request);
            else
                abort('401','Unauthorized',['errors.401']);
        }

//        return $next($request);
        return redirect('/admin');

    }
}
