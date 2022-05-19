<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Citizen;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard(){
        if(Auth::check()){
            if(Auth::user()->hasRole('Super_Admin')){
                return view('Super_Admin.super_dashboard');

            }if(Auth::user()->hasRole('Admin')){
                return redirect('/admin/dashboard');

            }if(Auth::user()->hasRole('User')){
                return redirect()->route('userDashboard');
            }
        }else{
            return view('homepage');
        }
    }
}
