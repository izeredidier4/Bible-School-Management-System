<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
       if(auth()->user()->role=="Admin")
       {
        return $next($request);
       }
      else if(auth()->user()->role=="Teacher")
       {
        return $next($request);
       }
      else if(auth()->user()->role=="Parent")
       {
        return $next($request);
       }
       else if(auth()->user()->role=="Child")
       {
        return $next($request);
       }
       else 
       {
        return redirect('home')->with('error','You have no access.');
       }
    }
}
