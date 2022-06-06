<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminProfileController extends Controller
{
    public function profileShow(){
        return view('admin.profile.user-profile');
    }

  function updatePhoto(Request $request){

        $path = 'user/';
        $file = $request->file('profile_image');
        $new_image_name = 'UIMG'.date('Ymd').uniqid().'.jpg';
        $upload = $file->move(public_path($path), $new_image_name);

        if(!$upload){
            return response()->json(['status'=>0, 'msg'=>'Something went wrong, try again later']);

        }else{

            $oldPhoto = User::find(Auth::user()->id)->getAttributes()['picture'];

            if($oldPhoto != ''){
                if(\File::exists(public_path($path.$oldPhoto))){
                    \File::delete(public_path($path.$oldPhoto));
                }
            }

            $update = User::find(Auth::user()->id)->update([
                'picture' => $new_image_name
            ]);
            return response()->json(['status' => 1, 'msg' => 'Success']);
        }

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
