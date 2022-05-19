<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Barangay;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Purok;
use Illuminate\Http\Request;

class SettingsController extends Controller
{

    public function brgy(){
        $barangay = Auth::user()->barangay_id;
        return $barangay;

    }
    public function index(){
        $purok = Purok::where('barangay_id', $this->brgy())->get('purok_name');

        return view('admin.settings.purok',compact('purok'));
    }
    public function barangay(){

        return view('admin.settings.barangay_profile');
    }

    public function addPurok(Request $request){
        $request->validate(['purok_name' =>  'required|max:255',], ['purok_name.required' => 'Purok name is required',]);

        if(!Purok::where('purok_name', '=', $request->purok_name)->exists()){
            Purok::insert([
                'purok_name' => $request->purok_name,
                'barangay_id' => $this->brgy(),
            ]);

            $notification = ([
                'message' => 'Purok inserted successfully',
                'alert-type' => 'success',
            ]);
            return redirect()->back()->with($notification);
        }
        return back()->with('error', 'Purok name already exists.');
    }
}
