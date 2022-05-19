<?php

namespace App\Http\Controllers\Super_Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class AdminRegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:Super_Admin']);
    }

    public function SuperAdminDashboard(){
        return view('Super_Admin.super_dashboard');
    }
}
