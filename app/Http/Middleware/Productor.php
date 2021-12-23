<?php

namespace App\Http\Middleware;

use Closure;

class Productor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
  /*  public function handle($request, Closure $next)
    {
        
        if (auth()->user()->idrol==4){
            return $next($request);
            }
            else{
            return redirect('/');
            }
        
    }*/
    public function handle($request, Closure $next)
    {
        if (auth()->check() && auth()->user()->idrol==4)
        return $next($request);
 
        return redirect('/');
 
    }
}
