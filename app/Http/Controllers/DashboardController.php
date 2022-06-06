<?php

namespace App\Http\Controllers;

use App\Models\Events;
use App\Models\Visitor;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Citizen;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function barangay(){
        $barangay = Auth::user()->barangay_id;
        return $barangay;
    }

    public function index(){
        $citizens = Citizen::where('barangay_id',$this->barangay())->with('barangay')->count();
        $events = Events::where('barangay_id', $this->barangay())->count();
        $visitor = Visitor::where('barangay_id',$this->barangay())->pluck('id')->count();
        $users  = User::where('barangay_id',$this->barangay())->pluck('id')->count();
        return view('admin.dashboard', compact( 'citizens', 'events', 'visitor', 'users'));
    }

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
            return view('auth.login');
        }
    }
}
