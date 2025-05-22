<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class cakeAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {


        if(auth()->check() && auth()->user()->isAdmin == 1){
            return $next($request);
        } else {

        

        // Redirect or abort if the user is not an admin
        return redirect()->route('login')->with('error', 'You do not have admin access.');
    }
    }

}