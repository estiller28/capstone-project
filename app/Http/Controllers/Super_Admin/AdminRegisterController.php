<?php

namespace App\Http\Controllers\Super_Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class AdminRegisterController extends Controller
{
    public function SuperAdminDashboard(){
        return view('Super_Admin.super_dashboard');
    }
}
