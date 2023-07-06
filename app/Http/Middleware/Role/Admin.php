<?php

namespace App\Http\Middleware\Role;

use Closure;
use Illuminate\Http\Request;
use Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        
        if (!Auth::check()) {
            return redirect()->route('login');
        }


        //User role is admin
        if ( Auth::check() && auth()->user()->role_names === 'admin' )
        {
            // dd('dsfsd'); 
           return $next($request);


        }

        //If user role is student
        if(Auth::check() && auth()->user()->role_names === 'subadmin')
        {
           
            return redirect('/subadmin');
        }

          //If user role is student
        if(Auth::check() && auth()->user()->role_names === 'school')
        {
           
            return redirect('/school');
        }

          //If user role is student
        if(Auth::check() && auth()->user()->role_names === 'teacher')
        {
           
            return redirect('/teacher');
        }

          //If user role is student
        if(Auth::check() && auth()->user()->role_names === 'student')
        {
           
            return redirect('/student');
        }
    }
}
