<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {

            /* 
                if Prefix have admin and you not Auth!
                
                Like:
                if you click /admin/home
                return admin/login
            */
            if ($request->routeIs('admin.*')) {
                return route('admin.login');
            }
            
            return route('login');
        }
    }
}
