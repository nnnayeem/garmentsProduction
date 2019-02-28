<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AccessoriesMiddleware
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

        if($request->is('admin/accessorieses/*')){
            if($request->isMethod('get')){
                if(!$user->can('view accessories'))abort(401);
            }
        }elseif($request->is('admin/accessorieses/*/create')){
            if(!$user->can('create accessories'))abort(401);
        }elseif($request->is('admin/accessorieses/*/*/edit')){
            if(!$user->can('edit accessories'))abort(401);
        }elseif($request->is('admin/accessorieses/*/*/show')){
            if(!$user->can('show accessories'))abort(401);
        }elseif($request->is('admin/accessorieses/*/*')){
            if($request->isMethod('post')){
                if(!$user->can('update accessories'))abort(401);
            }
        }elseif($request->is('admin/accessorieses/store/*/*')){
            if(!$user->can('input accessories'))abort(401);
        }elseif($request->is('admin/accessorieses/store/*')){
            if($request->isMethod('post'))
                if(!$user->can('input accessories'))abort(401);
            else
                abort(404);
        }
        return $next($request);
    }
}
