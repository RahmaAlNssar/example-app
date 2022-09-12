<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class PermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // $path = $request->route();


       $url =  explode('.', $request->route()->getName());
       $model = $url[1];
       $action = $url[2];

        $permission = $model.'-'.$action;
       if($permission == $model.'-store' || $permission == $model.'-update' ){
        return $next($request);
       }


        elseif( in_array($permission, auth()->user()->getAllPermissions()->pluck('name')->toArray()) == true){
            return $next($request);
        }else{
            return abort(403, 'you do not have permissions');
        }



    }
}
