<?php

namespace App\Http\Controllers\Admin;
use App\Actions\Fortify\PasswordValidationRules;
use App\Exports\CitizenImportTemplate;
use App\Http\Controllers\Controller;
use App\Http\Traits\authIdentifier;
use App\Http\Traits\barangayIdentifier;
use App\Models\Events;
use App\Models\Purok;
use App\Models\Visitor;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Citizen;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CitizensImport;
use App\Exports\CitizensExport;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Log;

class CitizenController extends Controller
{
    use PasswordValidationRules;
    use barangayIdentifier;
    use authIdentifier;

    public $notification;

    public function index(){

        $this->authorize('Citizens');

        $citizens = Citizen::where('barangay_id', $this->barangayId())->with(['barangay', 'purok', 'user'])->get();
        $deleted_citizens = Citizen::where('barangay_id', $this->barangayId())->onlyTrashed()->latest()->paginate(5);
        return view('admin.citizens.citizens_list', compact('citizens','deleted_citizens'));
    }

    public function addCitizenView(){

        $this->authorize('Citizens');

        $purok = Purok::where('barangay_id', $this->barangayId())->pluck('purok_name', 'id' );
        return view('admin.citizens.citizens_create', compact('purok'));
    }

    public function addCitizen(Request $request){
        $this->authorize('Citizens');

        $request->validate([
            'first_name' => 'required|unique:citizens|max:255',
            'middle_name' => 'max:255|nullable',
            'last_name' => 'required|max:255',
        ]);

        $citizen_data = ([
            'first_name'    => $request->first_name,
            'middle_name'   => $request->middle_name,
            'last_name'     => $request->last_name,
            'barangay_id'   => $this->barangayId(),
            'purok_id'      => $request->purok,
            'created_at'    => Carbon::now(),
        ]);

        Citizen::create($citizen_data);

        $notification = ([
            'message' => 'Citizen inserted successfully',
            'alert-type' => 'success',
        ]);
        return redirect()->route('citizens')->with($notification);
    }

    public function edit($id){
        $this->authorize('Citizens');

        $citizen = Citizen::find($id);
        $puroks= Purok::where('barangay_id', $this->barangayId())->get();
        $permissions = Permission::all();
        $user = User::with('roles','permissions')->where('id', $citizen->user_id)->first();

        if($user){
            $userPermissions =  $user->getAllPermissions();
            return view('admin.citizens.citizens_edit', compact('citizen', 'userPermissions', 'permissions', 'user', 'puroks'));
        }

        $puroks= Purok::where('barangay_id', $this->barangayId())->get();
        return view('admin.citizens.citizens_edit', compact('citizen',  'user', 'puroks', 'permissions'));

    }

    public function updateCitizenImage(Request $request){
        $this->authorize('Citizens');

        $citizen = $request->input('citizen_id');
        $path = 'user/';
        $file = $request->file('profile_image');
        $new_image_name = 'UIMG'.date('Ymd').uniqid().'.jpg';
        $upload = $file->move(public_path($path), $new_image_name);

        if(!$upload){
            return response()->json(['status'=> 0, 'msg'=>'Something went wrong, try again later']);

        }else{
            $oldPhoto = Citizen::find($citizen)->getAttributes()['picture'];
            if($oldPhoto != ''){
                if(\File::exists(public_path($path.$oldPhoto))){
                    \File::delete(public_path($path.$oldPhoto));
                }
            }
            $update = Citizen::find($citizen);
            $update->picture = $new_image_name;

            $update->save();
            return response()->json(['status' => 1, 'msg' => 'Success']);
        }

    }

    public function updateAdminPermission(Request $request, $id){

        $this->authorize('Citizens');
        $citizen = Citizen::find($id);
        $user = User::with('permissions')->where('id', $citizen->user_id)->first();

        $request->validate([
            'permission' => 'required',
        ]);

        $permission = $request->permission;
        $user->syncPermissions($permission);

        $notification = ([
            'message' => 'User permission updated successfully',
            'alert-type' => 'info',
        ]);

        return redirect()->back()->with($notification);
    }

    public function createCitizenUser(Request $request, $id){
        $this->authorize('Citizens');

        $citizen = Citizen::find($id);
        $request->validate([
            'email' => 'required|unique:users',
            'password' => $this->passwordRules(),
        ]);

        if($citizen){
            if($request->role == 2){
                $user = User::create([
                    'name' => $citizen->first_name. ' '. $citizen->last_name,
                    'email' => $request->email,
                    'barangay_id' => $citizen->barangay_id,
                    'password' => Hash::make($request->password),
                ]);
                $user->assignRole('Citizen');

                $citizen->user_id = $user->id;
                $citizen->email = $user->email;
                $citizen->save();

                $notification = ([
                    'message' => 'User created successfully',
                    'alert-type' => 'info',
                ]);
                return redirect()->back()->with($notification);
            }
        }else{
            Log::error($citizen);
        }

    }

    public function updateCitizenAccess(Request $request, $id){
        $this->authorize('Citizens');

        $citizen = Citizen::find($id);
        $request->validate([
            'password' => $this->passwordRules()
        ]);

        if($request->roles == 2){
            User::find($citizen->user_id)->update([
                'password' => Hash::make($request->password),
            ]);

            $notification = ([
                'message' => 'Citizen password updated successfully',
                'alert-type' => 'info',
            ]);
            return redirect()->back()->with($notification);

        }else{
            dd($citizen);
        }
    }


    public function update(Request $request, $id){
        $this->authorize('Citizens');

        Citizen::findOrfail($id)->update([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'purok_id' => $request->purok,
            'updated_at' => Carbon::now(),
        ]);
        $this->notification = ([
            'message' => 'Citizen updated successfully',
            'alert-type' => 'info',
        ]);

        return redirect()->route ('citizens')->with($this->notification);
    }


    public function delete($id){
        $this->authorize('Citizens');
        Citizen::findorfail($id)->delete();

        $notification = [
            'message' => 'Citizen archived successfully',
            'alert-type' => 'warning',
        ];
        return redirect()->back()->with($notification);
    }


    public function restore($id){
        $this->authorize('Citizens');
        Citizen::withTrashed()->find($id)->restore();

        $notification = ([
            'message' => 'Citizen restored successfully',
            'alert-type' => 'success',
        ]);
        return redirect()->back()->with($notification);
    }
    public function forceDelete($id){
        Citizen::withTrashed()->findOrfail($id)->forceDelete();

        $notification = ([
            'message' => 'Citizen permanently deleted',
            'alert-type' => 'error',
        ]);

        return redirect()->back()->with($notification);

    }
    public function CitizensImport(Request $request){
        $this->authorize('Citizens');
        $request->validate([
            'template' => 'required|mimes:xls,csv,xlsx',
        ]);

        try {
            if($request->has('template')){
                Excel::import(new CitizensImport(), $request->file('template'));
                $notification = ([
                    'message' => 'Citizen inserted successfully',
                    'alert-type' => 'success',
                ]);

                return redirect()->back()->with($notification);
            }
        }catch (\Exception $e) {
            $notification = ([
                'message' => 'Incorrect import data',
                'alert-type' => 'error',
            ]);
            return redirect()->back()->with($notification);
        }
    }

    public function CitizensExport(){
        $this->authorize('Citizens');

        return Excel::download(new CitizensExport(), 'All-Citizens.xlsx');
    }

    public function CitizensExportTemplate(){
        $this->authorize('Citizens');

        return Excel::download(new CitizenImportTemplate(), 'Citizen-Import-Template.xlsx');
    }
}

