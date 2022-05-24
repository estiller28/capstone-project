<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Barangay;
use App\Models\Citizen;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Purok;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SettingsController extends Controller
{

    public function brgy(){
        $barangay = Auth::user()->barangay_id;
        return $barangay;
    }
    public function index(){

        return view('admin.settings.purok');

    }

    public function getPurok(){
        $purok = Purok::all('id', 'purok_name');
        return DataTables::of($purok)
            ->addIndexColumn()
            ->addColumn('actions', function ($row){
                return '<div class="btn-group"
                            <button class="btn btn-primary" data-id="'.$row['id'].'"
                            id="purok_edit"><a href=""><i class="mr-3 text-primary fas fa-edit"></i></a></button>
                        </div>
                       <div class="btn-group"
                              <button class="btn btn-primary" data-id="'.$row['id'].'"
                            id="purok-delete"><a href=""><i class="mr-3 text-danger fas fa-archive"></i></a></button>
                       </div>';
            })
            ->rawColumns(['actions'])
            ->make(true);

    }
    public function barangay(){

        return view('admin.settings.barangay_profile');
    }

    public function addPurok(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'purok_name' => 'required|max:255',
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'code' => 0, 'error' => $validator->errors()->toArray()
            ]);

        }else{
            if (!Purok::where('purok_name', '=', $request->purok_name)->exists()) {
                $purok = Purok::insert([
                    'purok_name' => $request->purok_name,
                    'barangay_id' => $this->brgy(),
                ]);

                if (!$purok) {
                    return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
                } else {
                    return response()->json(['code' => 1, 'msg' => 'Purok inserted successfully']);
                }
            } else {
                return response()->json(['code' => 2, 'msg' => 'Purok name already exists']);
            }
        }
    }

    public function getPurokDetails(Request $request){
        $purok_id = $request->purok_id;

        $purok = Purok::find($purok_id);

        return response()->json(['details' => $purok]);
    }

    public function updatePurok(Request $request){
        $purok_id = $request->purokId;

        $validator = \Validator::make($request->all(), [
            'purok_name' => 'required|max:255',
        ]);

        $puroks = Purok::where('id', '!=', $purok_id)->pluck('purok_name')->toArray();

        if(!$validator->passes()){
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        }
        else{

            if(!in_array($request->purok_name, $puroks)){
                $purok = Purok::find($purok_id);
                $purok->purok_name = $request->purok_name;
                $purok->save();

                if(!$purok){
                    return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
                }else if(!Purok::where('purok_name', $request->purok_name)){
                    return response()->json(['code' => 3, 'msg' => 'No changes has been made']);
                }
                else{
                    return response()->json(['code' => 1, 'msg' => 'Purok updated successfully']);
                }
            }
            else{
                return response()->json(['code' => 2, 'msg' => 'Purok name already exists']);
            }
        }
    }

    public function deletePurok(Request $request){

        $purok_id = $request->purok_id;
        $deletePurok = Purok::find($purok_id)->delete();

        if($deletePurok){
            return response()->json(['code' => 1, 'msg' => 'Purok deleted successfully']);
        }else{
            return response()->json(['code' => 0, 'msg' => 'Something went wrong!']);
        }

    }


}
