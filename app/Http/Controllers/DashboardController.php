<?php

namespace App\Http\Controllers;

use App\Models\Events;
use App\Models\Purok;
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
        $recentlyAddedCitizens = Citizen::where('barangay_id', $this->barangay())->latest()->limit('4')->get(['first_name', 'last_name', 'picture', 'created_at']);
        $recentVisitors = Visitor::where('barangay_id', $this->barangay())->latest()->limit('5')->get();

//        $purok = Purok::where('barangay_id', auth()->user()->barangay_id)->pluck('id', 'purok_name');

        return view('admin.dashboard', compact( 'citizens', 'events', 'visitor', 'users', 'recentlyAddedCitizens', 'recentVisitors'));
    }

    public function dashboard(){
        if(Auth::check()){
            if(Auth::user()->hasRole('Super Admin')){
                return redirect('/super/admin');

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
