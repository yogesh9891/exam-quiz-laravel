<?php

namespace App\Http\Controllers\DeputyAdmin;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){

         return view('deputy_admin.dashboard');
    }
}
