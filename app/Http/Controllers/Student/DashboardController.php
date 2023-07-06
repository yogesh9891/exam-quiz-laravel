<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){

         return view('student.dashboard');
    }
}
