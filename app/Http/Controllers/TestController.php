<?php

namespace App\Http\Controllers;

use App\Http\Traits\smsNotification;
use App\Models\Citizen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use App\Models\User;

class TestController extends Controller
{
    use smsNotification;

    public function index(){
        $user = User::where('id', Auth::user()->id)->with('citizen')->first();
        $citizen = Citizen::where('user_id', Auth::user()->id)->with('user')->first();
        $profilePhoto = $citizen->user->profile_photo_url;

        return view('admin.citizens.test', compact('citizen', 'profilePhoto', 'user'));
    }
    public function addCitizen(Request $request){

        $validator = \Validator::make($request->all(),[
            'first_name' => 'required',
            'middle_name' => 'required',
            'last_name' => 'required',
        ]);
        if(!$validator->passes()){
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        }else{
            $citizen = Citizen::create([
                'first_name' => $request->first_name,
                'middle_name' => $request->middle_name,
                'last_name'  => $request->last_name,
            ]);

            if(!$citizen){
                return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
            }
            else{
                return response()->json(['code' => 1, 'msg' => 'Citizen inserted successfully']);
            }

        }
    }

    public function getCitizen(){
        $citizen = Citizen::all('id', 'first_name', 'middle_name', 'last_name');

        return DataTables::of($citizen)
            ->addIndexColumn()
            ->addColumn('actions', function ($row){
                return '<div class="btn-group"
                            <button class="btn btn-primary" data-id=" '.$row['id'].'"
                            id="citizen_edit"><a href=""><i class="mr-3 text-primary fas fa-edit"></i></a></button>
                        </div>
                       <div class="btn-group"
                              <button class="btn btn-primary" data-id="'.$row['id'].'"
                              id="citizen_delete"><a href=""><i class="mr-3 text-danger fas fa-archive"></i></a></button>
                       </div>';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function getCitizenDetails(Request $request){

        $citizen_id = $request->citizen_id;
        $citizenDetails = Citizen::find($citizen_id);

        return response()->json(['details' => $citizenDetails]);

    }

    public function updateCitizen(Request $request){
        $citizen_id = $request->cid;

        $validator = \Validator::make($request->all(),[
            'first_name' => 'required',
            'middle_name' => 'required',
            'last_name' => 'required',
        ]);
        if(!$validator->passes()){
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        }
        else{
            $citizen = Citizen::find($citizen_id);
            $citizen->first_name = $request->first_name;
            $citizen->middle_name = $request->middle_name;
            $citizen->last_name = $request->last_name;
            $query = $citizen->save();

            if(!$query){
                return response()->json(['code' => 2, 'msg' => 'Something went wrong']);
            }else{
                return response()->json(['code' => 1, 'msg' => 'Citizen updated successfully']);
            }
        }
    }

    public function deleteCitizen(Request $request){
        $citizen_id = $request->citizen_id;
        $query = Citizen::find($citizen_id)->delete();

        if($query){
            return response()->json(['code' => 1, 'msg' => 'Citizen deleted successfully']);
        }else{
            return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
        }

    }
}
