<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class OrderMiddleware
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
        if($request->is('admin/orders')){
            if(!$user->can('view order'))abort(401);
        }elseif($request->is('admin/orders/*/create')){
            if(!$user->can('create order'))abort(401);
        }elseif($request->is('admin/orders/*/edit')){
            if(!$user->can('edit order'))abort(401);
        }elseif($request->is('admin/orders/*')){
            if(!$user->can('show order'))abort(401);
        }
        return $next($request);
    }
}
