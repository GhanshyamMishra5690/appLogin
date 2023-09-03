<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserAccess
{
    public $allowedRoutes = ['user','admin','admin'];
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $userType): Response
    {
        if(in_array(auth()->user()->type, $this->allowedRoutes)){
            return $next($request);
        }
          
        return response()->json(['You do not have permission to access for this page. '.auth()->user()->type.' = '.$userType]);
        /* return response()->view('errors.check-permission'); */
    }
}
