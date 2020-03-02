<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class TeacherMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        if (!$request->user()->isTeacher) {
            auth()->logout();
            return redirect()->route('login')->withMessage('No tiene permiso para acceder a esta sección.'); 
        }
        
        return $next($request);
    }
}
