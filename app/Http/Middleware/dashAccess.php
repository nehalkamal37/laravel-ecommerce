<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class dashAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::user()->role == 'admin'  ||  Auth::user()->role == 'super_admin'){
       $user= Auth::user();
           // if($user->hasRule('admin|super_admin')){

        
        return $next($request);
        }else{
            abort(403);
        }
    }
}
