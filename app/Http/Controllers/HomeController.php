<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;   
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
           if ( Auth::check() && auth()->user()->role_names === 'admin' )
        {
            // dd('dsfsd'); 
            return redirect('/admin');


        }

           if ( Auth::check() && auth()->user()->role_names === 'deputy_admin' )
        {
            // dd('dsfsd'); 
            return redirect('/deputy_admin');


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
