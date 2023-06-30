<?php

namespace App\Http\Middleware\Role;
 use  App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
class AdminRole  
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
      //  if(Auth::user()->role=='admin'){
        $x=1;
         if((Session::get('loguser'))->role=='admin'){
                  //strcmp($name1, $name2)
 
                  return $next($request);
          // return redirect()->route('login');
           
        }else{
            return redirect('/');
          //  return redirect('/dashboard');
        }
    //   return  redirect()->intended('login');
   // return redirect('/dashboard');
   
    }
}
