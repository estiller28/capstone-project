<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function profileShow(){
        return view('admin.profile.user-profile');
    }

    public function changePassword(Request $request){
        $this->validate($request, [
            'oldpassword' => 'required',
            'newpassword' => 'required',
        ]);

        $hashedPassword = Auth::user()->password;
        if (Hash::check($request->oldpassword , $hashedPassword)) {
            if (Hash::check($request->newpassword, $hashedPassword)) {
                $notification = ([
                    'message' => 'New password cannot be the old password',
                    'alert-type' => 'warning',
                ]);
                return redirect()->back()->with($notification);
            }
            else{
                $users = User::find(Auth::user()->id);
                $users->password = bcrypt($request->newpassword);
                $users->save();
                $notification = ([
                    'message' => 'Password updated successfully',
                    'alert-type' => 'info',
                ]);
                return redirect()->back()->with($notification);
            }
        }
        else{
            session()->flash('message','old password doesnt matched');
            return redirect()->back();
        }
    }
}
