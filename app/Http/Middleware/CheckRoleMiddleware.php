<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect('/');
        }
        if (!$request->user()->hasRole($role)) {    // https://stackoverflow.com/a/31790654/2823916
            return redirect('/');
        }
        
        return $next($request);
    }
}
