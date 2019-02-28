<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class BuyerMiddleware
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

        if($request->is('admin/buyers')){
            if(!$user->can('view buyer'))abort(401);
        }elseif($request->is('admin/buyers/create')){
            if(!$user->can('create buyer'))abort(401);
        }elseif($request->is('admin/buyers/*/edit')){
            if(!$user->can('edit buyer'))abort(401);
        }elseif($request->is('admin/buyers/*')){
            if($request->isMethod('post'))
                if(!$user->can('delete buyer'))abort(401);
            elseif($request->isMethod('get'))
                if(!$user->can('view order'))abort(401);
        }
        return $next($request);
    }
}
