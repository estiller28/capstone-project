<?php

namespace App\Http\Controllers\Guest;

use App\Actions\Fortify\PasswordValidationRules;
use App\Http\Controllers\Controller;
use App\Models\Barangay;
use App\Models\Citizen;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class CreateCitizenUser extends Controller
{
    use PasswordValidationRules;
    public function index(){

        $barangay = Barangay::all('id', 'barangay_name');
        return view('home.registerCitizen', compact('barangay'));
    }

    public function userDashboard(){
        return view('User.userDashboard');
    }

    public function registerCitizen(Request $request){

        $request->validate([
            'email'         => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'      => $this->passwordRules(),
            'first_name'    => ['required', 'max:255'],
            'last_name'     => ['required', 'max:255'],
        ]);

        $citizen = Citizen::where('first_name', $request->first_name)
            ->where('last_name', $request->last_name)->first();

        if($citizen){
            $user = User::create([
                'name'          => $request->first_name. ' '. $request->last_name,
                'email'         => $request->email,
                'password'      => Hash::make($request->password),
            ])->assignRole('User');

            Auth::guard('web')->login($user);

            if($user){
                Citizen::where('first_name', $request->first_name)
                    ->where('last_name', $request->last_name)
                    ->update(['user_id' => $user->id, 'email' => $user->email]);
            }
            return redirect()->route('userDashboard');

        }else{
            return back()->with('error', 'You are not a citizen of this Barangay');
        }
    }
}
