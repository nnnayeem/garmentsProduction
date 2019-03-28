<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RequestPlatformMiddleware
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

        if($request->is('admin/request-platform')){
            if(!$user->can('view request-platform'))abort(401);
        }elseif ($request->is('admin/request-platform/create')) {
            if(!$user->can('create request-platform'))abort(401);
        }elseif ($request->is('admin/request-platform/store')) {
            if(!$user->can('create request-platform'))abort(401);
        }elseif ($request->is('admin/request-platform/*/edit')) {
            if(!$user->can('edit request-platform'))abort(401);
        }
        return $next($request);
    }
}
